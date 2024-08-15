<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user()->load('roleUser.roleName');
            $token = $user->createToken('Token Name')->plainTextToken;
            $roleName = $user->roleUser->roleName;
            return response()->json([
                'message' => 'Login succesffuly Done',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'role_name' => $roleName
                ],
                'token' => $token
            ], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
