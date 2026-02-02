<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Client;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Order;
use App\Models\Magasin\Product;
use App\Models\Magasin\ProductColorSize;
use App\Models\Magasin\VendorSystem;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['isMagasinAgent']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = null;
        if(Cart::count() > 0){
            $magasin = Magasin::find(AuthMagasinAgent());
            $users = $magasin->users;
            $clients = Client::where('magasin_id',AuthMagasinAgent())->get();
            return view('magasin.cart.index',['clients' => $clients,'users' => $users]);
        }

        Toastr()->warning('Votre panier est vide', 'Panier vide', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Cart::destroy();
        Toastr()->success('Votre panier a bien été vidé', 'Vider le panier', ["positionClass" => "toast-top-right"]);
        return redirect()->route('magasin.home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->qty != null && $request->unite_id != null) {
        
            $duplicata = Cart::search(function ($cartItem, $rowId) use ($request){
                if ($cartItem->id == $request->product_id && $cartItem->options->productColorSizeId == $request->getProductColorSize) {
                    return $cartItem->id == $request->product_id;
                }
            });
            
            // dd($request->all());

            $getProductColorSizeId = null;
            $color = null;
            $size = null;
            $qty = null;
            $uniteCode = null;
            $vendor_system_id = null;
            $quantityFinale = null;
            
            $product = Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->first();
            if($request->getProductColorSize != null)
            {
                $attribute = ProductColorSize::where('id',$request->getProductColorSize)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->first();
                $getProductColorSizeId = $attribute->id;
                $color = $attribute->color->name;
                $size = $attribute->size->name;
                $quantityFinale = $attribute->quantity;
            }else{
                $quantityFinale = $product->quantity;
            }

            // if($request->size != null)
            // {
            //     $size = $request->size;
            // }else {
            //     $size = null;
            // }

            if ($duplicata->isNotEmpty()) {
                Toastr()->warning('Ce produit est déjà dans votre panier', 'Produit éxistant', ["positionClass" => "toast-top-right"]);
                return back();
            }

            $vendor_system = VendorSystem::where('id',$request->unite_id)->where('magasin_id',AuthMagasinAgent())->first();
            
            if($vendor_system)
            {
                if ($vendor_system->status == 1) {
                    $qty = $request->qty;
                }else{
                    $qty = $request->qty * $vendor_system->quantity;
                    // dd($qty);
                }
                $uniteCode = $vendor_system->unite->code;
                $vendor_system_id = $vendor_system->id;
            }

            // dd($quantityFinale);

            if ($qty <= $quantityFinale) {
                Cart::add($product->id, $product->name, $qty, $product->price,
                array(
                    'productColorSizeId' => $getProductColorSizeId,
                    'color' => $color,
                    'size' => $size,
                    'unite' => $uniteCode,
                    'vendor_system_id' => $vendor_system_id,
                    'request_qty' => $request->qty
                    ))
                ->associate('App\Models\Magasin\Product');
                
                // dd(Cart::content());
                // array('size' => $request->size,'color' => $request->color)
                
                Toastr()->success('Votre produit a bien été ajouté au panier', 'Ajout au panier', ["positionClass" => "toast-top-right"]);
                return back();
            }else{
                Toastr()->warning('Cette quantite n\'existe pas pour ce produit', 'Quatite indisponible', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }else{
            Toastr()->warning('La quantite et l\'unite sont obligatoire', 'Ajout au panier', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        if ($qty < $product->model->quantity) {
            Cart::update($rowId,$qty);
            return back();
        }

        Toastr()->warning('Il n\' y a pas cette quantité pour ce produit', 'Qunatité insuffisante', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        if ($qty >= 1) {
            Cart::update($rowId,$qty);
            return back();
        }
        Toastr()->warning('La quantité minimum du produit est requise a 1', 'Quantité minimum', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        Toastr()->success('Votre produit a bien été supprimé dans le panier', 'Supprésion de produit', ["positionClass" => "toast-top-right"]);
        if (Auth::guard('magasin')->user()) {
            return redirect()->route(('magasin.home'));
        }else {
            return redirect()->route(('agent.home'));
        }
    }


    protected function checkNotAvailable()
	{
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
            return false;
        }
	}
    

    protected function generateCode(int $lenght = 6) : string
	{
	   return Random::generate($lenght, "0-9");
	}
}
