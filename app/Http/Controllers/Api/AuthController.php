<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function auth(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->getMessageBag(),400);
        }

        $user=User::where('email',$request->email()->first());
        if($user){
            //generate JWT
            $isValidPassword=Hash::check($request->password,$user->password);
            if($isValidPassword){
                $token=$this->generateToken($user);
                return response()->json([
                    'token'=> $token
                ]);
            }
        }

        return response()->json([
            'messages'=>'Invalid Credentials'
        ]);
    }

    private function generateToken($user){
        $jwtKey=env('JWT_KEY');
        $jwtExpired=env('JWT_EXPIRED');

        $now=now()->timestamp;    //unix timestamp
        $expired=now()->addMinutes($jwtExpired)->timestamp;

        //iss kalau bisa isi nama domain
        $payload=[
            'iat'=>$now,
            'iss'=>'stream.id',
            'nbf'=>$now,
            'exp'=>$expired,
            'user'=>$user            
        ];

        $token=JWT::encode($payload,$jwtKey,'HS256');
        return $token;
    }
}
