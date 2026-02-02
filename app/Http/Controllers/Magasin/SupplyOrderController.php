<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Supply;
use App\Models\Magasin\SupplyOrder;
use App\Models\Magasin\SupplyOrderProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SupplyOrderController extends Controller
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
        return view('magasin.supplies.vendor.index',
        [
            'orders' => SupplyOrder::where('request_id',AuthMagasinAgent())->orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        SupplyOrder::where('id',$id)->where('supply_id',request()->supply_id)->where('magasin_id',AuthMagasinAgent())
            ->update([
                'delivery' => 1
            ]);
        Toastr()->success('Votre livraison a bien été validée', 'Validation de la livraison', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'bon_commande' => 'required|string',
            'deivery_date' => 'require|date',
        ]);

        $verify = SupplyOrder::where("magasin_id", AuthMagasinAgent())->latest()->first();
        if ($verify) {
            $newOrder = $verify->order + 1;
        }else {
            $newOrder = 1;
        }

        $verifyBonCommande = SupplyOrder::where("magasin_id", AuthMagasinAgent())->where('supply_id',$request->supply_id)->where('bon_commande',$request->bon_commande)->first();
        // dd($supply_magasin);
        if ($verifyBonCommande) {
            Toastr()->error('Ce bon de commande éxiste pour ce magasin', 'Bon éxistant', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            $supply_magasin = Supply::where('id',$request->supply_id)->first();
            $request_id = null;
            if($supply_magasin->id != null){
                $request_id = $supply_magasin->id;
            }
             SupplyOrder::create([
                'order' => $newOrder,
                'bon_commande' => $request->bon_commande,
                'slug' => str_replace('/','',Hash::make(Str::random(2).$request->supply_id)),
                'date' => $request->delivery_date,
                'supply_id' => $request->supply_id,
                'magasin_id' => AuthMagasinAgent(),
                'status' => 2,
                'delivery' => 2,
                'request_id' => $request_id
            ]);
            Toastr()->success('Votre commande de devis a bien été ajouté', 'Ajout de commande devis', ["positionClass" => "toast-top-right"]);
            return back();
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $supply = Supply::where('owner_id',AuthMagasinAgent())->where('slug',$slug)->first();
        return view('magasin.supplies.buyer.index',
        [
            'orders' => SupplyOrder::where('magasin_id',AuthMagasinAgent())->where('supply_id',$supply->id)->orderBy('id','desc')->get(),
            'supplie' => $supply
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        return view('magasin.supplies.invoice',
        [
            'order' => SupplyOrder::where("magasin_id", AuthMagasinAgent())->orWhere('request_id',AuthMagasinAgent())->where('slug',$slug)->where('status',1)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'bon_commande' => 'required|string',
            'deivery_date' => 'require|date',
        ]);
        
        SupplyOrder::where('id',$id)->where("magasin_id", AuthMagasinAgent())->where('supply_id',$request->supply_id)->update([
            'bon_commande' => $request->bon_commande,
            'date' => $request->delivery_date,
        ]);

        Toastr()->success('Votre commande de devis a bien été modifié', 'Modification de commande devis', ["positionClass" => "toast-top-right"]);
        return back();
    }
    
    public function status(Request $request, string $id)
    {
        $commande = SupplyOrder::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first();
        if ($commande->supply_order_products->count() > 0) 
        {
            $poductValidateCount = SupplyOrderProduct::where('supply_order_id',$commande->id)->where('status',1)->get();
            // dd($poductValidateCount->count());
            if ($commande->supply_order_products->count() == $poductValidateCount->count()) {
                $this->validate($request,[
                    'status' => 'required|numeric',
                ]);

                // dd('yes');
                
                $dateUpdate = null;
                $incvoiceNum = null;
                $methode = null;
                if($request->status == 1){
                    $this->validate($request,[
                        'methode' => 'required|numeric',
                    ]);
                    $dateUpdate = now();
                    
                    $num = SupplyOrder::where("request_id", AuthMagasinAgent())->latest()->first();
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
        
                Toastr()->success('Le status de cette commande a bien été modifié', 'Modification de commandes', ["positionClass" => "toast-top-right"]);
                return back();
            }else {
                Toastr()->error('Vous devez supprimer les produits non valider', 'Validation des produits requis', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }else {
            Toastr()->error('Vous n\'aviez pas de produit pour cette commande', 'Pas de produit', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SupplyOrder::where('id',$id)->where('supply_id',request()->supply_id)->where('magasin_id',AuthMagasinAgent())->delete();
        Toastr()->success('Votre commande de devis a bien été supprimé', 'Suppréssion de commandes', ["positionClass" => "toast-top-right"]);
        return back();
    }

}
