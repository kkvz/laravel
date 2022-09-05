<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JWTVerfifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwtKey=env('JWT_KEY');
        $jwt=$request->bearerToken();

        try{
            $token=JWT::decode($jwt,new Key($jwtKey,'HS256'));
            
            $request->attributes->add([
                'user'=>$token->user
            ]);
            
            return $next($request);
        }catch(BeforeValidException $e){
            return response()->json(['message' => 'Token is not valid'],401);
        }catch(ExpiredException $e){
            return response()->json(['message'=>'Token already expired']);
        }catch(SignatureInvalidException $e){
            return response()->json(['message'=>'Invalid Token Signature']);
        }catch(\Throwable $e){
            return response()->json(['message'=>'unauthorized'],401);
        }

        return $next($request);
    }
}
