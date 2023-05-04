<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(LoginRequest $request)
    {
        try {

            $data = $request->validated();
            if (!Auth::attempt([
                'email' => $data['email'],
                'password' => $data['password']
            ])) {
                return response()->json([
                    'error' => 0,
                    'msg' => 'wrong email or password'
                ]);
            }
            $token = $request->user()->createToken('auth_token');
            return response()->json([
                'error' => 0,
                'msg' => 'successfully logedin',
                'token' => $token->plainTextToken
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 1,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
