<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLogoutMiddleware
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
        $lenght = strlen("logout");
        if (substr(url()->current(), (strlen(url()->current()) - $lenght)) == "logout") {
            return $next($request);
        }
        if(Auth::check()){
            if (Auth::user()->roles_id != 3) {
                return redirect('admin');
            }
            else{
                return redirect('cus/profile');
            }
        }
        return $next($request);
    }
}
