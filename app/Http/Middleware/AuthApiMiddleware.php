<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\JtwPassport;
use Closure;
use Illuminate\Http\Request;

class AuthApiMiddleware
{
    use JtwPassport;
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

            $this->checkAuthorizationToken($request);

        }catch (\Exception $e){

            return response()->json(["code" => $e->getCode(), "message" => $e->getMessage()],$e->getCode(), [], JSON_UNESCAPED_UNICODE);

        }

        return $next($request);
    }

    private function checkAuthorizationToken(Request $request)
    {
        list($type,$stringToken) = $this->getAuthorizationHeader($request);

        $this->validateToken($stringToken);
    }

}
