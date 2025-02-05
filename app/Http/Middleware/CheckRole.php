<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
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
        $user = $request->user();

        if($user){
            if($user->isAdmin()){
                return $next($request);
            }
            else if($user->isMhs()){
                return $next($request);
            }
        }
        return back()->with('error', 'Access Denied');
    }
}
