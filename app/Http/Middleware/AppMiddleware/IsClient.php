<?php

namespace App\Http\Middleware\AppMiddleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->guest()) {
            Toastr()->error('Désolé, la page a vxpirée', 'Page éxpirée', ["positionClass" => "toast-top-right"]);
            return redirect()->guest('login');
        }
        
        if (Auth::guard('web')->user()) {
            return $next($request);
        }else {
            Toastr()->warning('Désolé, accés refusé', 'Accés refusé', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
