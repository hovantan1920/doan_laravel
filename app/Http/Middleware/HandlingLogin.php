<?php

namespace App\Http\Middleware;

use Closure;

class HandlingLogin
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
        if($request->has('username') && $request->has('password'))
            return $next($request);
        return redirect('account');
    }
}
