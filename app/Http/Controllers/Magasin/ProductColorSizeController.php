<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Color;
use App\Models\Magasin\Product;
use App\Models\Magasin\ProductColorSize;
use App\Models\Magasin\Size;
use Illuminate\Http\Request;

class ProductColorSizeController extends Controller
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
    public function create()
    {
        $sizes = explode(",",request()->sizes);
        if (request()->sizes) {
            foreach ($sizes as  $size) {
                $sizeExist = Size::where('product_id',request()->product_id)->where('name',$size)->where('magasin_id',AuthMagasinAgent())->first();
                if (!$sizeExist) {
                    Size::create([
                        'name' => $size,
                        'product_id' => request()->product_id,
                        'visible' => 1,
                        'magasin_id' => AuthMagasinAgent()
                    ]);
                }else{
                    Toastr()->warning('Cette taille existe pour ce produit', 'taille existe', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }

            Toastr()->success('Vos tailles ont bien ete ajouter', 'Ajout de tailles', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->warning('Veiller remplire les champs', 'Champ vide', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $colors = explode(",",$request->colors);
        if ($request->colors) {
            foreach ($colors as  $color) {
                $colorExist = Color::where('product_id',$request->product_id)->where('name',$color)->where('magasin_id',AuthMagasinAgent())->first();
                if (!$colorExist) {
                    Color::create([
                        'name' => $color,
                        'product_id' => $request->product_id,
                        'visible' => 1,
                        'magasin_id' => AuthMagasinAgent()
                    ]);
                }else{
                    Toastr()->warning('Cette couleur existe pour ce produit', 'Couleur existe', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }

            Toastr()->success('Vos couleurs ont bien ete ajouter', 'Ajout de couleurs', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->warning('Veiller remplire les champs', 'Champ vide', ["positionClass" => "toast-top-right"]);
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('magasin.produits.product_color_size',
        [
            'product' => Product::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $sizeExist = Size::where('product_id',request()->product_id)->where('name',request()->name)->where('magasin_id',AuthMagasinAgent())->first();
        if (!$sizeExist) {
            Size::where('id',$id)->where('product_id',request()->product_id)->where('magasin_id',AuthMagasinAgent())
            ->update([
                'name' => request()->name,
                'product_id' => request()->product_id,
                'visible' => request()->visible,
                'magasin_id' => AuthMagasinAgent()
            ]);
            Toastr()->success('La taille a ete modifier avec success', 'Ajout de tailles', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->warning('Cette taille existe pour ce produit', 'Taille existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $colorExist = Color::where('product_id',$request->product_id)->where('name',$request->name)->where('magasin_id',AuthMagasinAgent())->first();
        if (!$colorExist) {
            Color::where('id',$id)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())
            ->update([
                'name' => $request->name,
                'product_id' => $request->product_id,
                'visible' => $request->visible,
                'magasin_id' => AuthMagasinAgent()
            ]);
            Toastr()->success('La couleur a ete modifier avec success', 'Ajout de couleurs', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->warning('Cette couleur existe pour ce produit', 'Couleur existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Color::where('id',$id)->where('product_id',request()->product_id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('La couleur a ete supprimer avec success', 'Suppression de couleurs', ["positionClass" => "toast-top-right"]);
        return back();
    }

     /**
     * Remove the specified resource from storage.
     */
    public function deleteSize(string $id)
    {
        Size::where('id',$id)->where('product_id',request()->product_id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('La taille a ete supprimer avec success', 'Suppression de tailles', ["positionClass" => "toast-top-right"]);
        return back();
    }

    // Gestion de la synchronisation et les quantites

    public function addSynchro(Request $request){
        $this->validate($request,[
            'color' => 'required|numeric',
            'size' => 'required|numeric',
            'visible' => 'required|boolean',
        ]);

        $getSynchroExist = ProductColorSize::where('color_id',$request->color)->where('size_id',$request->size)->where('product_id',$request->product_id)
        ->where('magasin_id',AuthMagasinAgent())->first();
        if(!$getSynchroExist){
            ProductColorSize::create([
                'color_id' => $request->color,
                'size_id' => $request->size,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'visible' => $request->visible,
                'magasin_id' => AuthMagasinAgent(),
            ]);

            $productSum = ProductColorSize::where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->sum('quantity');
            
            Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->update(['quantity' => $productSum]);

            Toastr()->success('Cette configuration a bien ete ajouter', 'Ajout de configuration', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->warning('Cette configuration existe', 'Configuration existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function updateSynchro(Request $request,$id){
        $this->validate($request,[
            'color' => 'required|numeric',
            'size' => 'required|numeric',
            'visible' => 'required|boolean',
        ]);

        $getSynchroExist = ProductColorSize::where('color_id',$request->color)->where('size_id',$request->size)->where('product_id',$request->product_id)
        ->where('magasin_id',AuthMagasinAgent())->first();
        if(!$getSynchroExist){
            ProductColorSize::where('id',$id)->where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->update([
                'color_id' => $request->color,
                'size_id' => $request->size,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'visible' => $request->visible,
                'magasin_id' => AuthMagasinAgent(),
            ]);

            $productSum = ProductColorSize::where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->sum('quantity');
            
            Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->update(['quantity' => $productSum]);

            Toastr()->success('Cette configuration a bien ete ajouter', 'Ajout de configuration', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->warning('Cette configuration existe', 'Configuration existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function deleteSynchro(Request $request,$id){
        ProductColorSize::where('id',$id)->where('product_id',request()->product_id)->where('magasin_id',AuthMagasinAgent())->delete();
        $productSum = ProductColorSize::where('product_id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->sum('quantity');
        Product::where('id',$request->product_id)->where('magasin_id',AuthMagasinAgent())->update(['quantity' => $productSum]);
        Toastr()->success('La configuration a ete supprimer avec success', 'Suppression de configuration', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
