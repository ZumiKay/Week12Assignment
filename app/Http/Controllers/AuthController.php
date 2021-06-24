<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function Register (RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response($user , Response::HTTP_CREATED);
    }
    public function Login (Request $request)
    {
        if(!Auth::attempt($request->only('email' , 'password'))){
            return \response([
               'error' => 'invalid Credential'
            ],Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt' , $token , 60 * 24 );
        return \response([
            'Token' => $token,
            'user' => $user
        ])->withCookie($cookie);

    }
    public function Logout ()
    {
        $cookie = Cookie::forget('jwt');
        return \response([
            'message' => 'successed'
        ])->withCookie($cookie);

    }
}
