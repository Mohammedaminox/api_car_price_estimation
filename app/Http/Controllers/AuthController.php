<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = $request->user();
    
            if ($user->hasRole('admin')) {
                // For admin role
                $token = $user->createToken('AdminToken')->plainTextToken;
            } else {
                // For user role
                $token = $user->createToken('UserToken')->plainTextToken;
            }
    
            return response()->json(['token' => $token], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
