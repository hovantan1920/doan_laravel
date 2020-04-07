<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CusLoginMiddleware
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
        if(!Auth::check()){
            return redirect('cus')->with('msg', 'You must Login!');
        }
        if( Auth::user()->roles_id != 3){
            Auth::logout();
            return redirect('cus')->with('msg', 'You is Admin!');
        }
        return $next($request);
    }
}
