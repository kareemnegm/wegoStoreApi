<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null)
            {auth()->shouldUse($guard);
                // to use different headerName -->Authorization to 'auth-token'
            // $token= $request->header('auth-token');
            // $request->headers->set('auth-token',(string)$token,true);
            // $request->headers->set('Authorization','Bearer'.$token,true);
            try{
                    $user=JWTAuth::parseToken()->authenticate();
            }catch(TokenExpiredException $e){
                return response()->json(['code:401', 'unauthenticated']);
            }catch(JWTException $e){
                return response()->json(['token invalid,'.$e->getMessage()],401);
            }
        }
        return $next($request);
    }
}
