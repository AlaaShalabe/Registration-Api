<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function Logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'error' => 0,
            'msg' => 'Successfully logedout'
        ]);
    }
}
