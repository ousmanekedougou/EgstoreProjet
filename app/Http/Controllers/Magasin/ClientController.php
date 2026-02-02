<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Client;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Order;
use App\Models\Magasin\Payment;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
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
        $magasin = Magasin::find(AuthMagasinAgent());
        return view('magasin.clients.index',['clients' => $magasin->users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $magasin = Magasin::find(AuthMagasinAgent());
        return view('magasin.clients.simple',['clients' => $magasin->clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required|numeric',
            'name' => 'required|string',
            'adress' => 'required|string',
            'email' => 'string|email|unique:clients',
            'phone' => 'required|numeric|unique:clients',
            'account' => 'numeric',
        ]);

        // dd($request->account);

        $depot = null;
        $credit = null;
        $account = null;
        $name_type = null;
        $status_type = null;
        $email_type = null;
        $phone_type = null;
        $rccm = null;
        $ninea = null;

        if($request->account == 1){
            $this->validate($request,[
                'depot' => 'required|numeric',
            ]);

            $depot = $request->depot;
            $account = 1;
        }elseif ($request->account == 3 || $request->account == null) {
            $credit = null;
            $depot = null;
            $account = 3;
        }

        if ($request->type == 2) {
            $this->validate($request,[
                'name_type' => 'required|string|unique:clients',
                'status_type' => 'required|string',
                'email_type' => 'string|email|unique:clients',
                'phone_type' => 'required|string|unique:clients',
                'rccm' => 'required|string|unique:clients',
                'ninea' => 'required|string|unique:clients',
            ]);

            $name_type = $request->name_type;
            $status_type = $request->status_type;
            $rccm = $request->rccm;
            $ninea = $request->ninea;
            $name_type = $request->name_type;
            $email_type = $request->email_type;
            $phone_type = $request->phone_type;
        }else {
            $status_type = 'Individuel';
        }
        
        // dd($name_type);

        Client::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->email)),
            'amount' => null,
            'depot' => $depot,
            'credit' => $credit,
            'account' => $account,
            'name_type' => $name_type,
            'status_type' => $status_type,
            'rccm' => $rccm,
            'email_type' => $email_type,
            'phone_type' => $phone_type,
            'ninea' => $ninea,
            'magasin_id' => AuthMagasinAgent(),
        ]);

        Toastr()->success('Votre client a bien été ajouté', 'Ajout de clients', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders = Order::where('user_id',$id)->where('magasin_id',AuthMagasinAgent())->orderBy('id','DESC')->get();
        return view('magasin.clients.show',[
            'client' => User::where('id',$id)->where('is_active',1)->first(),
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orders = Order::where('client_id',$id)->where('magasin_id',AuthMagasinAgent())->orderBy('id','DESC')->get();
        return view('magasin.clients.show',[
            'client' => Client::where('id',$id)->first(),
            'orders' => $orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first();
        $amount = null;
        $credit = null;
        $account = null;
        $depot = null;
        $rccm = null;
        $name_type = null;
        $status_type = null;
        $email_type = null;
        $phone_type = null;
        $ninea = null;
        
        if($client->account == 2){
            if ($request->amount <= $client->credit) {
                // dd($client->restant);
                if ($request->amount <= $client->restant) {
                    if ($client->credit > $client->amount) {
                        $amount = $client->amount + $request->amount;
                        $account = 2;
                        $credit = $client->credit;
                        Payment::create(['client_id' => $id,'magasin_id' => AuthMagasinAgent(),'date' => Carbon::now(),'amount' => $request->amount]);
                    }
                }elseif($client->restant == null){
                    if ($client->credit > $client->amount) {
                        $amount = $client->amount + $request->amount;
                        $account = 2;
                        $credit = $client->credit;
                        Payment::create(['client_id' => $id,'magasin_id' => AuthMagasinAgent(),'date' => Carbon::now(),'amount' => $request->amount]);
                    }
                }else {
                    Toastr()->error('Ce montant est superieur a la somme restante', 'Surplus du montant restant', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }else {
                Toastr()->error('Ce montant est superieur a la somme acréditée', 'Surplus du montant', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }elseif ($client->account == 3 || $client->account == null) {
            if ($request->depot != null) {
                $account = 1;
            }else{
                $account = 3;
            }
            $depot = $request->depot;
            $credit = null;
            $amount = null;
        }

        if ($request->type != 1) {
            $name_type = $request->name_type;
            $status_type = $request->status_type;
            $email_type = $request->email_type;
            $phone_type = $request->phone_type;
            $ninea = $request->ninea;
            $rccm = $request->rccm;
        }

        // dd($account);
        $client->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->adress,
            'amount' => $amount,
            'depot' => $depot,
            'credit' => $credit,
            'account' => $account,
            'name_type' => $name_type,
            'status_type' => $status_type,
            'email_type' => $email_type,
            'phone_type' => $phone_type,
            'rccm' => $rccm,
            'ninea' => $ninea,
        ]);

        $client->update(['restant' => $client->credit - $client->amount,]);


        if ($client->account == 2 && $client->credit == $client->amount) {
            Order::where('client_id',$client->id)
                ->where('magasin_id',AuthMagasinAgent())
                ->where('status',2)
                ->where('type',2)->update(['status' => 1 , 'type' => 1]);

            $client->update(['account' => 3,'amount' => null,'credit' => null, 'restant' => null]);

            Payment::where('client_id',$client->id)
                ->where('magasin_id',AuthMagasinAgent())->delete();

        }

        Toastr()->success('Votre client a bien été modifié', 'Modification de clients', ["positionClass" => "toast-top-right"]);
        return back();
    }

  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Client::where('id',$id)->delete();
        Toastr()->success('Votre client a bien été supprimé', 'Suppréssion de clients', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
