<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\About;
use App\Models\Magasin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Magasin\Order;
use App\Models\Magasin\Product;
use App\Models\Magasin\ProductColorSize;
use App\Models\Magasin\VendorSystem;
use App\Models\Magasin\Vente;
use App\Models\User\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Barryvdh\DomPDF\Facade\Pdf;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
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
        return view('magasin.orders.index',['orders' => Order::where('magasin_id',AuthMagasinAgent())->orderBy('id','DESC')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('magasin.nouvelle.index');
    }


    public function pdf($slug)
    {
        $authName = null;

        if (Auth::guard('magasin')->user()) {
            $authName = Auth::guard('magasin')->user()->name;
        }elseif (Auth::guard('agent')->user()) {
            $authName = Auth::guard('agent')->user()->name;
        }

        $data  = [
                    'order' => Order::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->where('status',1)->first(),
                    'authName' => $authName
                ];

        $pdf =  PDF::loadview('magasin.orders.invoice',$data);

        return $pdf->download('Facture.pdf');
    }

    // public function post(Request $request)
    // {
    //     if ($this->checkNotAvailable()) {
    //         Toastr()->warning('Un produit n\'est plus disponible dans votre panier', 'Indisponibilite de produits', ["positionClass" => "toast-top-right"]);
    //         return back();
    //     }

    //     $this->validate($request,[
    //         'client' => 'required|string',
    //         'name' => 'string',
    //         'phone' => 'numeric',
    //         'bon_commande' => 'string',
    //     ]);


    //     $name = null;
    //     $phone = null;
    //     $client = null;
        
    //     if($request->client == -1){
    //         $name = $request->name;
    //         $phone = $request->phone;
    //     }

    //     $user = Client::where('id',$request->client)->first();
    //     if ($user) {
    //         $client = $user->id;
    //     }else {
    //         $client = null;
    //     }

    //     // dd($client);
        

    //     $products = [];
    //     $i = 0;

    //     foreach (Cart::content() as $product) {
    //         $products['product_' .$i][] = $product->model->image;
    //         $products['product_' .$i][] = $product->model->name;
    //         $products['product_' .$i][] = $product->model->price;
    //         $products['product_' .$i][] = $product->qty;
    //         $products['product_' .$i][] = $product->options->color;
    //         $products['product_' .$i][] = $product->options->size;
    //         $i++;

    //         $item = Product::find($product->model->id);

    //         $item->update(['quantity' => $item->quantity - $product->qty]);

    //         Vente::create([
    //             'slug' => str_replace('/','',Hash::make(Str::random(1).$product->model->name)),
    //             'quantity' => $product->qty,
    //             'date' => now(),
    //             'product_id' => $product->model->id,
    //             'magasin_id' => AuthMagasinAgent(),
    //         ]);
    //     }

    //     // $code = $this->generateCode();
    //     $verify = Order::where("magasin_id", AuthMagasinAgent())->latest()->first();
    //     if ($verify) {
    //         $newOrder = $verify->order + 1;
    //     }else {
    //         $newOrder = 00001;
    //     }

    //     $getAmount = Cart::subtotal();
    //     $amount = str_replace(',', '', $getAmount);

    //     Order::create([
    //         'order' => $newOrder,
    //         'name' => $name,
    //         'phone' => $phone,
    //         'magasin_id' => AuthMagasinAgent(),
    //         'client_id' => $client,
    //         'slug' => str_replace('/','',Hash::make(Str::random(2).$newOrder)),
    //         'bon_commande' => $request->bon_commande,
    //         'products' => serialize($products),
    //         'date' => now(),
    //         'amount' => number_format($amount,2, ',','.'),
    //         'status' => 2
    //     ]);

    //     Cart::destroy();

    //     Toastr()->success('Votre commande a bien été ajouté', 'Ajout de commandes', ["positionClass" => "toast-top-right"]);
    //     return redirect()->route('magasin.commande.index');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($this->checkNotAvailable()) {
            Toastr()->warning('Un produit n\'est plus disponible dans votre panier', 'Indisponibilité de produits', ["positionClass" => "toast-top-right"]);
            return back();
        }

        $this->validate($request,[
            // 'client' => 'required|string',
            // 'bon_commande' => 'string',
            'name' => 'string',
            'phone' => 'numeric',
        ]);
        // dd(request('passif'));
        // dd($request->all());

        $name = null;
        $phone = null;
        $client = null;
        $abonne = null;
        $type = null;
        $status = null;
        $amount = str_replace(',', '', Cart::subtotal());

        
        $userClient = Client::where('phone',$request->phone)->first();
        if ($userClient) {
            if ($request->passif != 1) {

                if ($userClient->account == 1) {
                    if ($userClient->depot >= $amount) {

                        $userClient->update(
                        [
                            'amount' => $userClient->amount + $amount,
                            'restant'  => $userClient->depot - $amount
                        ]);
                        $client = $userClient->id;
                        $type = 1;
                        $status = 1;

                        
                        if ($userClient->amount == null) {
                            $userClient->update(['account' => 3]);
                        }
                        
                    }else {
                        Toastr()->warning('Le montant est insuffisant', 'Montant insuffisant', ["positionClass" => "toast-top-right"]);
                        return back();
                    }

                    

                }elseif ($userClient->account == 2) {
                    Toastr()->error('Ce clients à des passifs en cours', 'Passifs en cours', ["positionClass" => "toast-top-right"]);
                    return back();
                }elseif($userClient->account == 3){
                    if ($userClient->credit == 0 && $userClient->amount == 0) {
                        $userClient->update(['credit' => $userClient->credit,'amount' => $userClient->amount,'account' => $userClient->account,'restant' => $userClient->restant]);
                        $client = $userClient->id;
                        $status = 2;
                    }
                }

            }elseif ($request->passif == 1) {

                if($userClient->account == 3 || $userClient->account == null){
                    if ($userClient->credit == 0 && $userClient->amount == 0) {
                        $userClient->update(['credit' => $amount,'account' => 2]);
                        $client = $userClient->id;
                        $type = 2;
                        $status = 2;
                    }
                }else {
                    Toastr()->error('Ce clients à des actifs / passifs en cours', 'Actifs ou Passifs', ["positionClass" => "toast-top-right"]);
                    return back();
                }

            }

            $name = null;
            $phone = null;
            
        }elseif (!$userClient) {
            $client = null;
            $name = $request->name;
            $phone = $request->phone;
            $status = 2;
        }

        $user = User::where('phone',$request->phone)->first();
        if ($user) {
            $abonne = $user->id;
            $name = null;
            $phone = null;
        }else {
            $abonne = null;
            $name = $request->name;
            $phone = $request->phone;
        }

        $products = [];
        $i = 0;

        
        foreach (Cart::content() as $product) {
            $products['product_' .$i][] = $product->model->image;
            $products['product_' .$i][] = $product->model->name;
            $products['product_' .$i][] = $product->model->price;
            $products['product_' .$i][] = $product->qty;
            $products['product_' .$i][] = $product->options->color;
            $products['product_' .$i][] = $product->options->size;
            $products['product_' .$i][] = $product->options->unite;
            $products['product_' .$i][] = $product->options->request_qty;
            $i++;

            
            // $voendor_system_get = VendorSystem::where('id',$product->options->vendor_system_id)->where('magasin_id',AuthMagasinAgent())->first();
            
            // $item = Product::find($product->model->id);

            // $getQty = $voendor_system_get->quantity * $product->qty;


            // $item->update(['quantity' => $item->quantity - $getQty]);

            $productColorSize = ProductColorSize::where('id',$product->options->productColorSizeId)->where('product_id',$product->model->id)->where('magasin_id',AuthMagasinAgent())->first();
            // dd($productColorSize);
            $productColorSize->update(['quantity' => $productColorSize->quantity - $product->qty]);

        }

        $productUpdateQuantity = ProductColorSize::where('product_id',$product->model->id)->where('magasin_id',AuthMagasinAgent())->sum('quantity');
        Product::where('id',$product->model->id)->where('magasin_id', AuthMagasinAgent())->update([
            'quantity' => $productUpdateQuantity
        ]);

        // $code = $this->generateCode();
        $verify = Order::where('magasin_id', AuthMagasinAgent())->latest()->first();
        if ($verify) {
            $newOrder = $verify->order + 1;
        }else {
            $newOrder = 1;
        }


        // $getAmount = Cart::subtotal();
        

        Order::create([
            'order' => $newOrder,
            'name' => $name,
            'phone' => $phone,
            'magasin_id' => AuthMagasinAgent(),
            'user_id' => $abonne,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$newOrder)),
            'bon_commande' => $request->bon_commande,
            'products' => serialize($products),
            'date' => now(),
            'client_id' => $client,
            'amount' => number_format($amount,2, ',','.'),
            'status' => $status,
            'type' => $type
        ]);

        Cart::destroy();

        Toastr()->success('Votre commande a bien été ajouté', 'Ajout de commandes', ["positionClass" => "toast-top-right"]);
        return redirect()->route('magasin.commande.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('magasin.orders.show',['order' => Order::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $authName = null;

        if (Auth::guard('magasin')->user()) {
            $authName = Auth::guard('magasin')->user()->name;
        }elseif (Auth::guard('agent')->user()) {
            $authName = Auth::guard('agent')->user()->name;
        }

        return view('magasin.orders.invoice',[
            'order' => Order::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first(),
            'auth_about' => About::where('magasin_id',Auth::guard('magasin')->user()->id)->first(),
            'authName' => $authName
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'status' => 'required|numeric',
        ]);

        $type = null;

        if ($request->status == 1) {
            $this->validate($request,[
                'methode' => 'required|numeric',
            ]);
            $type = 1;
        }


        Order::where('id',$id)->where('magasin_id',AuthMagasinAgent())
        ->update(
        [   'status' => $request->status,
            'payment_created_at' => now(),
            'methode' => $request->methode,
            'type' => $type
        ]);

        Toastr()->success('Le status de cette commande a bien été modifié', 'Modification de commandes', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::where('id',$id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('Votre commande a bien été supprimé', 'Suppréssion de commandes', ["positionClass" => "toast-top-right"]);
        return back();
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
}


