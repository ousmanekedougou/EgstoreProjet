<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Category;
use App\Models\Magasin\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class SubCategoryController extends Controller
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
            // 'type' => 'required|numeric',
            'visible' => 'required|boolean',
        ]);

        SubCategory::create([
            'name' => $request->name,
            // 'type' => $request->type,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
            'visible' => $request->visible,
            'category_id' => $request->category_id]);

        Toastr()->success('Votre sous-catégorie a bien été ajoutéé', 'Ajout de sous-catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('magasin.subcategorie.index',['cateorie' => Category::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first()]);
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
        SubCategory::where('id',$id)->update([
            'name' => $request->name,
            // 'type' => $request->type,
            'visible' => $request->visible,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name))]);
        Toastr()->success('Le status de cette sous-catégorie a bien été modifiéé', 'Modification de sous-catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory::where('id',$id)->delete();
        Toastr()->success('Votre sous-catégorie a bien été suppriméé', 'Suppréssion de sous-catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
