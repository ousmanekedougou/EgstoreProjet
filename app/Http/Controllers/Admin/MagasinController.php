<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Magasin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagasinController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.magasin.index',['magasins' => Magasin::paginate(20)]);
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
        //
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
        Magasin::where('id',$id)->update(['is_active' => $request->is_active]);
        Toastr()->success('Le status de ce compte magasin a bien été modifié', 'Modification de magasins', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $magasin = Magasin::where('id',$id)->first();
        Storage::delete($magasin->logo);
        $magasin->delete();
        Toastr()->success('Ce compte magasin a bien été supprimé', 'Suppression de magasins', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
