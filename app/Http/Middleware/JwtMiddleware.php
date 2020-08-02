<?php

namespace App\Http\Middleware;

use Closure;
<<<<<<< HEAD
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
=======
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
<<<<<<< HEAD
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            } else {
=======
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired']);
            }else{
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
<<<<<<< HEAD

}
=======
}
>>>>>>> a95a8c2db1c0a2735325ecc72115360464a7a446
