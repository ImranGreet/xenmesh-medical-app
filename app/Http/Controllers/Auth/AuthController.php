<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function addStuffToHospital(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    // Create staff
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Attempt login
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'message' => 'Login failed after registration'
        ], 401);
    }

    // $user = Auth::user(); // Logged-in user

    // Create Sanctum token using the logged-in user
    // $token = $user->createToken('hospital_token')->plainTextToken;

    return response()->json([
        'message' => 'Staff added and logged in successfully',
        // 'user' => $user,
        // 'token' => $token
    ], 201);
}

}
