<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerHospitalMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role' =>      'required|string',
        ]);

          
        // Create staff
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
            'username'=> $request->name.$request->role,
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Login failed after registration'
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'message' => 'Staff added and logged in successfully',
            'user' => $user,
        ], 201);
    }

    public function loginHospitalMember(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login failed'
            ], 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();

        $token = $request->user()->createToken('hospital-system-access-token')->plainTextToken;

        return response()->json([
            'message' => 'Staff logged in successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logOutHospitalMember()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'No authenticated user found.',
            ], 401);
        }

        $user->tokens()->delete();

        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Staff logged out successfully.',
        ], 200);
    }
}
