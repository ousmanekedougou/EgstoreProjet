<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Magasin\Product;
use App\Models\Magasin\Size;
use App\Models\Magasin\SubCategory;
use App\Models\Magasin\Supply;
use App\Models\Magasin\Unite;
use App\Models\Magasin\VendorSystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProduitController extends Controller
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
        return view('magasin.produits.all_product',['products' => Product::where('magasin_id',AuthMagasinAgent())->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'qty_alert' => 'required|numeric',
            'exp_date' => 'required',
            'image' => 'required|image|mimes:PNG,png',
            // 'images.*' => 'image|mimes:PNG,png', 
            'supply_id' => 'required|numeric',
            'desc' => 'required|string',
            'visible' => 'required|boolean',
            'promot' => 'boolean',
            'unite_id' => 'required|numeric',
            'quantity_unite' => 'required|numeric',
            'price_achat' => 'required|numeric',
            'price_vente' => 'required|numeric',
            'colors' => 'required|string',
            'sizes' => 'required|string',
        ]);

        $productExist = Product::where('name',$request->name)->where('magasin_id',AuthMagasinAgent())->first();
        if(!$productExist){
            $imageName = '';
            if($request->hasFile('image'))
            {
                $file = $request->file('image');

                $Name = $request->name.'-'.Auth::guard('magasin')->user()->name.'.'. $file->getClientOriginalExtension();
                $image = Image::read($file);
                // Resize image
                if (!is_dir(storage_path("app/public/Products"))) {
                    mkdir(storage_path("app/public/Products/"), 0775, true);
                }
                $image->resize(530, 530, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/Products/'. $Name));

                $imageName = 'public/Products/'. $Name;
                
            }

            $validatePromotion = '';

            if($request->promot == null){
                $validatePromotion = null;
            }else {
                if($request->price_promotion < $request->price_vente){
                    $validatePromotion = $request->price_promotion;
                }else {
                    Toastr()->error('Le prix de la promotion doit etre inférieure au prix vente', 'Prix de la promotion', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }
            if($request->price_vente > $request->price_achat){
                $product = Product::create([
                    'name' => $request->name,
                    'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
                    'reference' => $request->reference,
                    'quantity' => $request->quantity,
                    'qty_alert' => $request->qty_alert,
                    'stock' => $request->quantity,
                    'image' => $imageName,
                    'exp_date' => $request->exp_date,
                    'desc' => $request->desc,
                    // 'images' => json_encode($data),
                    'promot' => $request->promot,
                    'promo_price' => $validatePromotion,
                    'visible' => $request->visible,
                    'magasin_id' => AuthMagasinAgent(),
                    'supply_id' => $request->supply_id,
                    'sub_category_id' => $request->sub_category_id
                ]);

                
                $colors = explode(",",$request->colors);
                if ($request->colors) {
                    foreach ($colors as  $color) {
                        Color::create([
                            'name' => $color,
                            'product_id' => $product->id,
                            'visible' => 1,
                            'magasin_id' => AuthMagasinAgent()
                        ]);
                    }
                }
                
                $sizes = explode(",",$request->sizes);
                if ($request->sizes) {
                    foreach ($sizes as  $size) {
                        Size::create([
                            'name' => $size,
                            'product_id' => $product->id,
                            'visible' => 1,
                            'magasin_id' => AuthMagasinAgent()
                        ]);
                    }
                }
                VendorSystem::create([
                    'unite_id' => $request->unite_id,
                    'price_achat' => $request->price_achat,
                    'price_vente' => $request->price_vente,
                    'quantity' => $request->quantity_unite,
                    'status' => 1,
                    'product_id' => $product->id,
                    'magasin_id' => AuthMagasinAgent(),
                ]);
                $product->update(['price' => $request->price_vente,'unique_code' => $product->magasin->prefix.'-'.str_pad($product->id, 6, '0', STR_PAD_LEFT)]);
                
                Toastr()->success('Votre produit a bien été ajouté', 'Ajout de produits', ["positionClass" => "toast-top-right"]);
                return back();
            }else{
                Toastr()->warning('Le prix de vente doit etre superieur au prix d\'achat', 'Ajout de produit', ["positionClass" => "toast-top-right"]);
                return back();  
            }
        }else{
            Toastr()->error('Ce produit existe dans votre stock', 'Ajout de produit', ["positionClass" => "toast-top-right"]);
            return back();  
        }
    }

 

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $subcategory = SubCategory::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first();

        $products = $subcategory->products()->orderBy('id','desc')->paginate(50);
        return view('magasin.produits.index',
        [
            'products' => $products,
            'subcategory' => $subcategory,
            'supplies'    => Supply::where('owner_id',AuthMagasinAgent())->get(),   
            'unites'  => Unite::where('magasin_id',AuthMagasinAgent())->where('visible',1)->get()      
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('magasin.produits.show',
        [
            'product'   => Product::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first(),
            'supplies'  => Supply::where('owner_id',AuthMagasinAgent())->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // dd('cjj');
        $this->validate($request,[
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);
        $productExist = Product::where('name',$request->name)->where('magasin_id',AuthMagasinAgent())->first();
        if(!$productExist){

            $validatePromotion = '';
            $promot = null;
            $supplyId = null;
            
            $product = Product::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first();

            if($request->promot == null){
                $validatePromotion = null;
            }else {
                if($request->price_promotion < $request->price){
                    $validatePromotion = $request->price_promotion;
                }else {
                    Toastr()->error('Le prix de la promotion doit etre inférieure au prix normale', 'Pprix de la promotion', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }

            $imageName = '';
            if($request->hasFile('image'))
            {
                Storage::delete($product->image);
                // $imageName = $request->image->store('public/Products');
                $file = $request->file('image');

                $Name = $request->name.'-'.Auth::guard('magasin')->user()->name.'.'. $file->getClientOriginalExtension();
                $image = Image::read($file);
                // Resize image
                $image->resize(530, 530, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/Products/' . $Name));

                $imageName = 'public/Products/'. $Name;
            }else{
                $imageName = $product->image;
            }

            // $data = [];
            // $imagesUpdate = '';
            // if ($request->hasFile('images')) {
            //     foreach ($request->images as $image) {
            //         $imageStore = $image->store('Products/ImageSimilaires/');
            //         $data[] = $imageStore;
            //     }
            //     $imagesUpdate = json_encode($data);
            // }else {
            //     $imagesUpdate = $product->images;
            // }

            if ($request->promot != null) {
                $promot = 1;
            }else {
                $promot = 0;
            }

            if ($request->supply_id != null) {
                $supplyId = $request->supply_id;
            }else{
                 $supplyId = $product->supply_id;
            }

            $product->update([
                'name' => $request->name,
                'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
                'reference' => $request->reference,
                'quantity' => $request->quantity,
                'stock' => $request->quantity,
                'qty_alert' => $request->qty_alert,
                'desc' => $request->desc,
                'image' => $imageName,
                // 'images' => $imagesUpdate,
                'visible' => $request->visible,
                'promot' => $promot,
                'promo_price' => $validatePromotion,
                'exp_date' => $request->exp_date,
                'supply_id' => $supplyId,
                'magasin_id' => AuthMagasinAgent(),
                'sub_category_id' => $request->sub_category_id,
                'unique_code' => $product->magasin->prefix.'-'.str_pad($id, 6, '0', STR_PAD_LEFT)
            ]);

            Toastr()->success('Votre produit a bien été modifié', 'Modification de produits', ["positionClass" => "toast-top-right"]);
            return back();

        }else{
            Toastr()->error('Ce produit existe dans votre stock', 'Ajout de produit', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete_product = Product::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first();
        Storage::delete($delete_product->image);
        $delete_product->delete();
        Toastr()->success('Votre produit a bien été supprimé', 'Suppréssion de produits', ["positionClass" => "toast-top-right"]);
        return back();
    }

    // Les methodes de la gestion des unites des produits
    public function addVendorSystem(Request $request){
        $this->validate($request,[
            'unite_id' => 'required|string',
            'quantity' => 'required|numeric',
            'status_unite' => 'boolean',
        ]);

        // dd($request->all());

        $unite_status = VendorSystem::where('id',$request->unite_status)->where('status',1)->where('magasin_id',AuthMagasinAgent())->first();

        if ($unite_status->status == 1) {
            $price_achat = $unite_status->price_achat * $request->quantity;
            $price_vente = $unite_status->price_vente * $request->quantity;
        }else{
            $this->validate($request,[
                'price_achat' => 'required|numeric',
                'price_vente' => 'required|numeric',
            ]);

            $price_achat = $request->price_achat;
            $price_vente = $request->price_vente;
        }

        $uniteExist = VendorSystem::where('unite_id',$request->unite_id)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->first();
        $uniteStatusExist = VendorSystem::where('magasin_id',AuthMagasinAgent())->where('product_id',$request->product_id)->where('status',1)->first();
        if(!$uniteExist){
            if($uniteStatusExist && $uniteStatusExist->status == 1 &&  $request->status_unite == 1){
                Toastr()->error('Une unité de base a été ajouté pour ce produit', 'Unités de base', ["positionClass" => "toast-top-right"]);
                return back();
            }else{
                if($price_vente > $price_achat){
                    VendorSystem::create([
                        'unite_id' => $request->unite_id,
                        'price_achat' => $price_achat,
                        'price_vente' => $price_vente,
                        'quantity' => $request->quantity,
                        'status' => $request->status_unite,
                        'product_id' => $request->product_id,
                        'magasin_id' => AuthMagasinAgent(),
                    ]);

                    if($request->status_unite == 1){
                        Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())
                        ->update(['price' => $request->price_vente]);
                    }

                    Toastr()->success('Votre methode de vente a bien été ajouté', 'Ajout de methode', ["positionClass" => "toast-top-right"]);
                    return back();
                }else{
                    Toastr()->warning('Le prix de vente doit etre superieur au prix d\'achat', 'Ajout de methode', ["positionClass" => "toast-top-right"]);
                    return back();  
                }
            }
        }else{
            Toastr()->error('Cette unité existe pour ce produit', 'Unités existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function showVendorSystem($slug){
        $product = Product::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first();
        $unite_status = VendorSystem::where('product_id',$product->id)->where('status',1)->where('magasin_id',AuthMagasinAgent())->first();
        // dd($unite_status->id);
        return view('magasin.produits.product_unite_show',
        [
            'product' => $product,
            'unite_status' => $unite_status,
            'unites'  => Unite::where('magasin_id',AuthMagasinAgent())->where('id','!=',$unite_status->unite_id)->where('visible',1)->get() 
        ]);
    }

    public function updateVendorSystem(Request $request, $id){
        $this->validate($request,[
            'unite_id' => 'required|string',
            'quantity' => 'required|numeric',
            'status_unite' => 'boolean',
        ]);

        $unite_status = VendorSystem::where('id',$request->unite_status)->where('status',1)->where('magasin_id',AuthMagasinAgent())->first();

        if ($unite_status->status == 1) {
            $price_achat = $unite_status->price_achat * $request->quantity;
            $price_vente = $unite_status->price_vente * $request->quantity;
        }else{
            $this->validate($request,[
                'price_achat' => 'required|numeric',
                'price_vente' => 'required|numeric',
            ]);

            $price_achat = $request->price_achat;
            $price_vente = $request->price_vente;
        }

        $get_current_vendor = VendorSystem::where('id',$id)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->first();
        $uniteStatusExist = VendorSystem::where('id','!=',$id)->where('magasin_id',AuthMagasinAgent())->where('product_id',$request->product_id)->where('status',1)->first();
        if ($uniteStatusExist && $uniteStatusExist->status == 1 && $request->status_unite == 1) {
            Toastr()->error('Une unité de base a été ajouté pour ce produit', 'Unités de base', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            if($price_vente > $price_achat){
            
                VendorSystem::where('id',$id)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->update(
                    [
                        'unite_id' => $request->unite_id,
                        'price_achat' => $price_achat,
                        'price_vente' => $price_vente,
                        'quantity' => $request->quantity,
                        'status' => $request->status_unite,
                        'product_id' => $request->product_id,
                        'magasin_id' => AuthMagasinAgent(),
                    ]
                );

                if($request->status_unite == 1){
                    Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())
                    ->update(['price' => $request->price_vente]);
                }

                Toastr()->success('Votre methode de vente a bien été ajouté', 'Ajout de methode', ["positionClass" => "toast-top-right"]);
                return back();
            }else{
                Toastr()->warning('Le prix de vente doit etre superieur au prix d\'achat', 'Ajout de methode', ["positionClass" => "toast-top-right"]);
                return back();  
            }
        }
    }

    public function deleteVendorSystem($id){
        $get_unite = VendorSystem::where('id',$id)->where('product_id',request()->product_id)->where('magasin_id',AuthMagasinAgent())->first();
        if($get_unite->status == 1){
            Toastr()->error('Vous ne pouvez pas supprimer une unité de base', 'Unités de base', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            $get_unite->delete();
            Toastr()->success('Cette unité a bien été supprimé pour ce produit', 'Suppréssion de produits', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}

