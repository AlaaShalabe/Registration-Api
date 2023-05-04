<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function registration(RegistrationRequest $request)
    {
        try {
            $data = $request->validated();
            if ($data->failes()) {
                throw new \Exception('failed to validate ...!');
            }
            // $data['password'] = Hash::make($request->password);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'msg' => 'successfully registered',
                'token' => $user->createToken('auth_token')->plainTextToken
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 1,
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
