<?php

namespace App\Http\Middleware\AppMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('agent')->guest()) {
            Toastr()->error('Désolé, la page a éxpirée', 'Page éxpirée', ["positionClass" => "toast-top-right"]);
            return redirect()->guest('agent/login');
        }
        
        if (Auth::guard('agent')->user()) {
            return $next($request);
        }else {
            Toastr()->warning('Désolé, accés refusé', 'Accés refusé', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
