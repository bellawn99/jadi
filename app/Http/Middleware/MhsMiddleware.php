<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MhsMiddleware
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
        if(Auth::user()){
            if (Auth::user()->role=='Mahasiswa') {
                return $next($request);
            }
            if (Auth::user()->role=='Admin') {
                return $next($request);
            }            
        }else{
            // return redirect();
            return redirect('/login');
        }
    }
}
