<?php

namespace App\Http\Middleware;

use Closure;

class TransporteurMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role string
     * @return mixed
     */
    public function handle($request, Closure $next, $role=null)
    {
        //dd(session());
        return $next($request);
    }
}
