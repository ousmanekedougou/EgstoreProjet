<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isMagasinAgent');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('magasin_id',AuthMagasinAgent())->paginate(10);
        return view('magasin.categories.index',compact('categories'));
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
            'icon' => 'required|string',
            // 'type' => 'required|numeric',
            'visible' => 'required|boolean',
        ]);

        Category::create([
            'name' => $request->name,
            'icon' => $request->icon,
            // 'type' => $request->type,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
            'visible' => $request->visible,
            'magasin_id' => AuthMagasinAgent()]);

        Toastr()->success('Votre catégorie a bien été ajoutéé', 'Ajout de catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        Category::where('id',$id)->where('magasin_id',AuthMagasinAgent())
        ->update(
            [
                'name' => $request->name,
                'icon' => $request->icon,
                // 'type' => $request->type,
                'visible' => $request->visible,
                'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name))
            ]);
        Toastr()->success('le status de votre catégorie a bien été modifiéé', 'Modification de catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id',$id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('Votre categorie a bien été suppriméé', 'Suppréssion de catégories', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
