<?php

namespace App\Http\Middleware\AppMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsMagasin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('magasin')->guest()) {
            Toastr()->error('Désolé, la page a expirée', 'Page expirée', ["positionClass" => "toast-top-right"]);
            return redirect()->guest('magasin/login');
        }
        
        if (Auth::guard('magasin')->user()) {
            return $next($request);
        }else {
            Toastr()->warning('Désolé, acces refusé', 'Acces refusé', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
