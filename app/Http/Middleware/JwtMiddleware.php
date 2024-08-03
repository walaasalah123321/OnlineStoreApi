<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Trait\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->ApiResponse(500,"user not found");
            }
        } catch (JWTException $e) {
            if( $e instanceof TokenInvalidException){
                return $this->ApiResponse(500,"token invalid");
                
            }
            else if($e instanceof TokenExpiredException){
                return $this->ApiResponse(500,"token is expire");
                
            }
               else  return $this->ApiResponse(500,"Authorization token  not found");
                 
        }
        return $next($request);
    }
}
