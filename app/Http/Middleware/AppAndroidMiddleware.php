<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppAndroidMiddleware
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
        try{

            //$this->validateUserAgent($request);

        }catch (\Exception $e){

            return response(["code" => $e->getCode(), "message" => $e->getMessage() ],$e->getCode());

        }

        return $next($request);
    }

    private function validateUserAgent(Request $request)
    {
        if($request->header('x-app-navigateur') !== "app-android-transvargo")
        {
            throw new \Exception("Forbidden",403);
        }
    }
}