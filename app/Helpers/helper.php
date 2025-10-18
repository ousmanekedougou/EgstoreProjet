<?php

use App\Models\Magasin\Category;
use App\Models\Magasin\Product;
use App\Models\Magasin\SupplyOrder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

if (!function_exists('page_title')) {
    function page_title($title)
    {
        $magasinName = null;
        
        if (Auth::guard('magasin')->user()) {
            $magasinName = Auth::guard('magasin')->user()->name;
        }elseif (Auth::guard('agent')->user()) {
            $magasinName = Auth::guard('agent')->user()->magasin->name;
        }
        
        if (Auth::guard('magasin')->user() || Auth::guard('agent')->user()) {
            $base_title = $magasinName;
        }else {
            $base_title = 'E-Gstore';
        }
        return $base_title . ' - ' . $title ;
        
        // $base_title = 'E-Gstore';
        // if ($title === '') {
        //     return  $base_title;
        // } else {
        //     return $title . ' | ' . $base_title;
        // }
    }
}

if (!function_exists('set_active_roote')) {
    function set_active_roote($route)
    {
        return Route::is($route) ? 'active' : '';
    }
}

if (!function_exists('AuthMagasinAgent')) {
    function AuthMagasinAgent()
    {
        $magasinId = null;

        if (Auth::guard('magasin')->user()) {
            $magasinId = Auth::guard('magasin')->user()->id;
        }elseif (Auth::guard('agent')->user()) {
            $magasinId = Auth::guard('agent')->user()->magasin->id;
        }

        return $magasinId;
    }
}

if (!function_exists('AuthLogedNow')) {
    function AuthLogedNow()
    {
        $auth = null;

        if (Auth::guard('magasin')->user()) {
            $auth = Auth::guard('magasin')->user();
        }elseif (Auth::guard('agent')->user()) {
            $auth = Auth::guard('agent')->user()->magasin->first();
        }

        return $auth;
    }
}

if (!function_exists('AuthMagasinAgentVisible')) {
    function AuthMagasinAgentVisible()
    {
        $visible = null;

        if (Auth::guard('magasin')->user()) {
            $visible = Auth::guard('magasin')->user()->visible;
        }elseif (Auth::guard('agent')->user()) {
            $visible = Auth::guard('agent')->user()->magasin->visible;
        }

        return $visible;
    }
}

if (!function_exists('allCategorieCommercial')){

    function allCategorieCommercial()
    {
        $magasinId = null;

        if (Auth::guard('magasin')->user()) {
            $magasinId = Auth::guard('magasin')->user()->id;
        }elseif (Auth::guard('agent')->user()) {
            $magasinId = Auth::guard('agent')->user()->magasin->id;
        }

        $categories = Category::where('magasin_id',$magasinId)->where('visible',1)->get();

        return $categories;
    }

}

if (!function_exists('allCategorieLocation')){

    function allCategorieLocation()
    {
        $magasinId = null;

        if (Auth::guard('magasin')->user()) {
            $magasinId = Auth::guard('magasin')->user()->id;
        }elseif (Auth::guard('agent')->user()) {
            $magasinId = Auth::guard('agent')->user()->magasin->id;
        }

        $categories = Category::where('magasin_id',$magasinId)->where('visible',1)->get();

        return $categories;
    }

}


if (!function_exists('ProductStockAlert')) {
    function ProductStockAlert()
    {
        $ProductStockAlert = null;
        $ProductStockAlert = Product::where('magasin_id',AuthMagasinAgent())->where('quantity','>',0)->where('quantity','<',10)->get();
        if ($ProductStockAlert->count() > 0) {
            return Toastr()->warning('Vous avez ' .$ProductStockAlert->count(). ' produits dont le stock est en phase d\'epuisement', 'Alerte d\'epuisement', ["positionClass" => "toast-top-right"]);
        }
    }
}


if (!function_exists('ProductStockVide')) {
    function ProductStockVide()
    {
        $ProductStockVide = null;
        $ProductStockVide = Product::where('magasin_id',AuthMagasinAgent())->where('quantity',0)->get();
       if ($ProductStockVide->count() > 0) {
            return Toastr()->error('Vous avez ' .$ProductStockVide->count(). ' produits dont le stock est épuisé', 'Produit epuise', ["positionClass" => "toast-top-right"]);
       }
    }
}

if (!function_exists('OrderNotification')) {
    function OrderNotification()
    {
        $supplyOrder = SupplyOrder::where('request_id',AuthMagasinAgent())->where('notify',0)->where('status',2)->get();
        return $supplyOrder;
    }
}

