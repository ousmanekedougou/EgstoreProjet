<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Client;
use App\Models\Magasin\Commande;
use App\Models\Magasin\Magasin;
use App\Models\User\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ReservationController extends Controller
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
        return view('magasin.reserves.index',
        [
            'reserves' => Commande::where('magasin_id',AuthMagasinAgent())->where('type',1)->orderBy('id','DESC')->paginate(10)
        ]);
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
            'name' => 'string',
            'email' => 'string|email',
            'phone' => 'numeric',
        ]);

        $name = null;
        $email = null;
        $phone = null;
        $UserId = null;
        $clientId = null;

        $user = User::where('phone',$request->phone)->first();
        if ($user) {
            $UserId = $user->id;
        }else {
            $UserId = null;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
        }

        $client = Client::where('phone',$request->phone)->first();
        if ($client) {
            $clientId = $client->id;
        }else {
            $clientId = null;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
        }

        $verify = Commande::where("magasin_id", AuthMagasinAgent())->where('type',1)->latest()->first();
        if ($verify) {
            $newOrder = $verify->order + 1;
        }else {
            $newOrder = 1;
        }

        Commande::create([
            'order' => $newOrder,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'magasin_id' => AuthMagasinAgent(),
            'user_id' => $UserId,
            'client_id' => $clientId,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$newOrder)),
            'date' => now(),
            'type' => 1,
            'bon_commande' => $request->bon_commande,
            'status' => 2
        ]);

        Toastr()->success('Votre reservation a bien été ajouté', 'Ajout de résérvations', ["positionClass" => "toast-top-right"]);
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('magasin.reserves.show',['reserve' => Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',1)->first()]);
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
        return view('magasin.reserves.invoice',[
            'reserve' => Commande::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->where('type',1)->first(),
            'authName' => $authName
        ]);
    }

   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::where('id',$id)->where('type',1)->where('magasin_id',AuthMagasinAgent())->first();
        if ($commande->bagages->count() > 0) 
        {
            $this->validate($request,[
                'status' => 'required|numeric',
            ]);
            
            $dateUpdate = null;
            $incvoiceNum = null;
            $methode = null;
            if($request->status == 1){
                $this->validate($request,[
                    'methode' => 'required|numeric',
                ]);
                $dateUpdate = now();
                
                $num = Commande::where("magasin_id", AuthMagasinAgent())->where('type',1)->latest()->first();
                if ($num) {
                    $incvoiceNum = $num->num_invoice + 1;
                }else {
                    $incvoiceNum = 1;
                }
                
                $methode = $request->methode;
            }
    
            $commande->update(
            [   'status' => $request->status,
                'payment_created_at' => $dateUpdate,
                'num_invoice' => $incvoiceNum,
                'methode' => $methode
            ]);
    
            Toastr()->success('Le status de catte reservation a bien été modifié', 'Modification de résérvations', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->error('Vous n\'aviez pas de produit pour cette résérvation', 'Pas de produit', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',1)->delete();
        Toastr()->success('Votre reservation a bien été supprimé', 'Suppréssion de résérvations', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function delete(string $id){
        $deleteBagages = Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',1)->first();
        foreach ($deleteBagages->bagages as $bag) {
            $bag->delete();
        }
        $deleteBagages->update(
            [   'status' => 2,
                'amount' => null,
                'payment_created_at' => null,
                'num_invoice' => null,
                'methode' => null
            ]);
        return back();
    }
}
