<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class hbmAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->role_id == '1' || Auth::user()->role_id == '20')){
            return $next($request);
        }else{
            return redirect('/login')->with('error', 'Authentication Error');
        }
    }
}
