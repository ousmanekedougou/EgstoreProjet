<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Magasin\Unite;
class UniteController extends Controller
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
        return view('magasin.configuration.unite',['unites' => Unite::where('magasin_id',AuthMagasinAgent())->orderBy('id','desc')->get()]);
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
            'code' => 'required|string',
            'visible' => 'required|boolean',
        ]);
        $uniteExist = Unite::where('name',$request->name)->where('magasin_id',AuthMagasinAgent())->first();
        if(!$uniteExist){

            Unite::create([
                'name' => $request->name,
                'code' => $request->code,
                'visible' => $request->visible,
                'magasin_id' => AuthMagasinAgent()
            ]);

            Toastr()->success('Votre unité a bien été ajoutéé', 'Ajout de unités', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->error('Cette unité existe pour votre magasin', 'Unités existe', ["positionClass" => "toast-top-right"]);
            return back();
        }
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
         Unite::where('id',$id)->where('magasin_id',AuthMagasinAgent())
        ->update(
            [
                'name' => $request->name,
                'code' => $request->code,
                'visible' => $request->visible,
            ]);
        Toastr()->success('le status de votre unité a bien été modifiéé', 'Modification de unités', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Unite::where('id',$id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('Votre unité a bien été suppriméé', 'Suppréssion de unités', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
