<?php

namespace App\Http\Controllers\Magasin;
use App\Http\Controllers\Controller;
use App\Models\Magasin\Client;
use App\Models\Magasin\Commande;
use App\Models\Magasin\Order;
use App\Models\Magasin\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isMagasin')->except('icon');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commandes = Order::where('magasin_id',AuthMagasinAgent())->where('status','!=',1)->count();
        $bons = Commande::where('magasin_id',AuthMagasinAgent())->where('type',0)->where('status','!=',1)->count();
        $pro_format = Commande::where('magasin_id',AuthMagasinAgent())->where('type',1)->where('status','!=',1)->count();
        $clients = Client::where('magasin_id',AuthMagasinAgent())->count();

        $paimentNotification = null;
        $isPaymentDay = false;
        if (Auth::guard('magasin')->user()->inv_status == false) {
            $today = date('d');
            if (Carbon::now()->day <= Auth::guard('magasin')->user()->inv_at) {
                $paimentNotification = "L'inventaire de votre magasin doit ce faire le " .Auth::guard('magasin')->user()->inv_at ." de ce mois";
            }elseif (Carbon::now()->day == Auth::guard('magasin')->user()->inv_at) {
                $paimentNotification = "L'inventaire de votre magasin doit ce faire aujourd'hui";
            }
        }

        // if ($today == Auth::guard('magasin')->user()->inv_at) {
        //     $isPaymentDay = true;
        // }
        // Toastr()->success('Votre commande de devis a bien été ajouté', 'Ajout de commande', ["positionClass" => "toast-top-right"]);
        return view('magasin.home',[
            'products' => Product::where('magasin_id',AuthMagasinAgent())->where('visible',1)->paginate(20),
            'paimentNotification' => $paimentNotification,
            'isPaymentDay'        => $isPaymentDay,
            'commandes'           => $commandes,
            'bons'                => $bons,
            'pro_format'          => $pro_format,
            'clients'             => $clients,
        ]);
    }

    public function icon(){
        return view('magasin.icons.index');
    }
}
