<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Client;
use App\Models\Magasin\Color;
use App\Models\Magasin\Commande;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Product;
use App\Models\Magasin\ProductColorSize;
use App\Models\Magasin\Size;
use App\Models\Magasin\Unite;
use App\Models\Magasin\VendorSystem;
use App\Models\User\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BonController extends Controller
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
        if (AuthMagasinAgentVisible() == 1){
            $magasin = Magasin::find(AuthMagasinAgent());
            $clients = $magasin->users;
        }else {
            $clients = Client::where('magasin_id',AuthMagasinAgent())->get();
        }
        return view('magasin.bons.index',
        [
            'bons' => Commande::where('magasin_id',AuthMagasinAgent())->where('type',0)->orderBy('id','DESC')->paginate(10),
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // public function post(Request $request)
    // {
    //     $this->validate($request,[
    //         'client' => 'required|string',
    //         'bon_commande' => 'string',
    //         'name' => 'string',
    //         'email' => 'string|email',
    //         'phone' => 'numeric',
    //     ]);

    //     $name = null;
    //     $email = null;
    //     $phone = null;
    //     $client = null;
        
    //     if($request->client == -1){
    //         $name = $request->name;
    //         $email = $request->email;
    //         $phone = $request->phone;
    //     }

    //     $user = Client::where('id',$request->client)->first();
    //     if ($user) {
    //         $client = $user->id;
    //     }else {
    //         $client = null;
    //     }

    //     $verify = Commande::where("magasin_id", AuthMagasinAgent())->where('type',0)->latest()->first();
    //     if ($verify) {
    //         $newOrder = $verify->order + 1;
    //     }else {
    //         $newOrder = 00001;
    //     }

    //     Commande::create([
    //         'order' => $newOrder,
    //         'name' => $name,
    //         'email' => $email,
    //         'phone' => $phone,
    //         'magasin_id' => AuthMagasinAgent(),
    //         'client_id' => $client,
    //         'slug' => str_replace('/','',Hash::make(Str::random(2).$newOrder)),
    //         'bon_commande' => $request->bon_commande,
    //         'date' => now(),
    //         'type' => 0,
    //         // 'amount' => number_format($amount,2, ',','.'),
    //         'status' => 2
    //     ]);

    //     Toastr()->success('Votre résérvation a bien été ajouté', 'Ajout de résérvation', ["positionClass" => "toast-top-right"]);
    //     return back();
    // }

    
    public function getProductOption(int $id){
        $getUnityId = VendorSystem::where('product_id',$id)->where('magasin_id',AuthMagasinAgent())->get('unite_id');
        $colors = Color::where('product_id',$id)->where('magasin_id',AuthMagasinAgent())->get();
        $sizes = Size::where('product_id',$id)->where('magasin_id',AuthMagasinAgent())->get();
        $unites = Unite::whereIn('id', $getUnityId)->get();
        
        return response()->json([
            'status' => 1,
            'unites' => $unites,
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // 'client' => 'required|string',
            // 'bon_commande' => 'string',
            'name' => 'string',
            'email' => 'string|email',
            'phone' => 'numeric',
        ]);

        $name = null;
        $email = null;
        $phone = null;
        $user = null;
        $client = null;
        // $amount = str_replace(',', '', Cart::subtotal());
        
        // if($request->client == -1){
        //     $name = $request->name;
        //     $email = $request->email;
        //     $phone = $request->phone;
        // }

        $clientUser = Client::where('phone',$request->phone)->first();
        if ($clientUser) {
            if ($clientUser->account == 3) {
                $client = $clientUser->id;
            }else {
                Toastr()->error('Ce client à des actifs / passifs en cours', 'Bon non validé', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }else {
            $client = null;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
        }

        $userGet = User::where('phone',$request->phone)->first();
        if ($userGet) {
            $user = $userGet->id;
        }else {
            $user = null;
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
        }

        $verify = Commande::where("magasin_id", AuthMagasinAgent())->where('type',0)->latest()->first();
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
            'user_id' => $user,
            'client_id' => $client,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$newOrder)),
            'bon_commande' => $request->bon_commande,
            'date' => now(),
            'type' => 0,
            'status' => 2
        ]);

        Toastr()->success('Votre commande a bien été ajoutéé', 'Ajout de commande', ["positionClass" => "toast-top-right"]);
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('magasin.bons.show',
        [
            'bon' => Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',0)->first(),
            'unites'  => Unite::where('magasin_id',AuthMagasinAgent())->where('visible',1)->get(),
            'products'  => Product::where('magasin_id',AuthMagasinAgent())->where('visible',1)->get()
        ]);
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
        return view('magasin.bons.invoice',[
            'bon' => Commande::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->where('type',0)->first(),
            'authName' => $authName
        ]);
    }

   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::where('id',$id)->where('type',0)->where('magasin_id',AuthMagasinAgent())->first();
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

                $num = Commande::where("magasin_id", AuthMagasinAgent())->where('type',0)->latest()->first();
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

            Toastr()->success('Le status de cette résérvation a bien été modifiéé', 'Modification de résérvation', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Toastr()->error('Vous n\'aviez pas de produit pour cette résérvation', 'Pas de produit', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function validation($id){
        Commande::where('id',$id)->where('type',0)->where('magasin_id',AuthMagasinAgent())
        ->update(['validate' => 1]);
        Toastr()->success('Votre commande de bon a bien été validéé', 'Validation de bon', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',0)->delete();
        Toastr()->success('Votre résérvation a bien été suppriméé', 'Supprésion de résérvation', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function delete(string $id){
        $deleteBagages = Commande::where('id',$id)->where('magasin_id',AuthMagasinAgent())->where('type',0)->first();
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
