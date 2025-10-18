<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Product;
use App\Models\Magasin\SupplyOrder;
use App\Models\Magasin\SupplyOrderProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class SupplyOrderProductController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $slug)
    {
        // Lescommande recue dans le vando_order
        $supplyVendor = SupplyOrder::where('slug',$slug)->first();
        // dd($supplyVendor->magasin->name);
        return view('magasin.supplies.vendor.product',
        [
            'supplyOrder' => SupplyOrder::where('request_id',AuthMagasinAgent())->where('slug',$slug)->first(),
            'supplyVendor' => SupplyOrder::where('slug',$slug)->first(),
            'is_vendor_order' => 1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'inputs' => 'required',
        ]);
        // dd($request->inputs);
        foreach ($request->inputs as $input) 
        {
            $imageName = '';
            if($input['image'])
            {
                $imageName = $input['image']->store('public/Supplies/Products');
            }
            $colors = null;
            $sizes = null;
    
            if ($input['colors'] != '') {
                $colors = explode(",",$input['colors']);
            }else {
                $colors = null;
            }
    
            if ($input['sizes'] != '') {
                $sizes = explode(",",$input['sizes']);
            }else {
                $sizes = null;
            }

            SupplyOrderProduct::create([
                'name' => $input['name'],
                'slug' => str_replace('/','',Hash::make(Str::random(2).$input['name'])),
                'reference' => $input['reference'],
                'quantity' => $input['qty'],
                'image' => $imageName,
                'colors' => serialize($colors),
                'sizes' => serialize($sizes),
                'magasin_id' => AuthMagasinAgent(),
                'supply_order_id' => $request->supply_order_id
            ]);

        }
        Toastr()->success('Votre produit a bien été ajouté', 'Ajout de produits', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // Notre devis de commande dans le buyer
        return view('magasin.supplies.buyer.product',
        [
            'supplyOrder' => SupplyOrder::where("magasin_id", AuthMagasinAgent())->where('slug',$slug)->first(),
            'is_vendor_order' => 0
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function notify(string $slug)
    {
        $supplyOrderNotify = SupplyOrder::where("request_id", AuthMagasinAgent())->where('slug',$slug)->first();
        $supplyOrderNotify->update(['notify' => 1]);
        return view('magasin.supplies.product',['supplyOrder' => $supplyOrderNotify,'is_vendor_order' => 1]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = SupplyOrderProduct::where('id',$id)->where('supply_order_id',$request->supply_order_id)->where('magasin_id',AuthMagasinAgent())->first();
        if ($product->supply_order->status == 2) {

            $colors = null;
            $sizes = null;

            if ($request->colors != '') {
                $colors = serialize(explode(",",$request->colors));
            }else {
                $colors = $product->colors;
            }

            if ($request->sizes != '') {
                $sizes = serialize(explode(",",$request->sizes));
            }else {
                $sizes = $product->sizes;
            }

            $imageName = '';
            if($request->hasFile('image'))
            {
                $imageName = $request->image->store('public/Supplies/Products');
            }else{
                $imageName = $product->image;
            }

            $product->update([
                'name' => $request->name,
                'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
                'reference' => $request->reference,
                'quantity' => $request->quantity,
                'colors' => $colors,
                'sizes' => $sizes,
                'magasin_id' => AuthMagasinAgent(),
                'image' => $imageName,
                'supply_order_id' => $request->supply_order_id
            ]);
            Toastr()->success('Votre produit a bien ete modifié', 'Modification du produit', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->warning('Vous ne pouvez plus modifier ce produit', 'Modification non accéptée', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function updatePrice(Request $request, string $id)
    {
        // dd('djndjd');
        $product = SupplyOrderProduct::where('id',$id)->where('supply_order_id',$request->supply_order_id)->first();
        
        if ($product->supply_order->status == 2) {

            $product->update([
                'price' => $request->price,
                'amount' => $request->price * $product->quantity
            ]);
            $orderAmount = SupplyOrderProduct::where('magasin_id',$product->supply_order->magasin->id)->sum('amount');
            // dd($orderAmount);
            $product->supply_order->update(['amount' => $orderAmount]);

            Toastr()->success('Le prix du produit a bien ete modifié', 'Modification du prix', ["positionClass" => "toast-top-right"]);
            return back();

        }else {
            Toastr()->warning('Vous ne pouvez plus modifier ce produit', 'Modification non accéptée', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }


    public function status(Request $request, string $id)
    {
        // dd('djndjd');
        $product = SupplyOrderProduct::where('id',$id)->where('supply_order_id',$request->supply_order_id)->first();
        
        if ($product->supply_order->status == 2) {

            $product->update([
                'status' => 1,
            ]);
            Toastr()->success('La validation a été effectuée avec success', 'Validation de produits', ["positionClass" => "toast-top-right"]);
            return back();

        }else {
            Toastr()->warning('Vous ne pouvez plus modifier ce produit', 'Modification non accéptée', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = SupplyOrderProduct::where('id',$id)->where('supply_order_id',request()->supply_order_id)->where('magasin_id',AuthMagasinAgent())->first();
        if ($product->supply_order->status == 2) {
            $product->delete();
            Toastr()->success('Votre produit a bien été supprimé', 'Suppression de bagages', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->warning('Vous ne pouvez plus supprimer ce produit', 'Suppréssion non accéptée', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
