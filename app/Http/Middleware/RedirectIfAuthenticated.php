<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
         
        if($guard=='customers'){
           if(Auth::check()){
                if (Auth::guard('customers')->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
           } 
 
        }
        if($guard=='admin'){
            if(Auth::check()){
              if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
            }
        }
           
       
        return $next($request);
    }
}
