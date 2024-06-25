<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        // Data validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        // Create new User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Optionally
        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully'
        ], 201);
    }

    // Login for token authentication ---- MOBILE
    // public function login(Request $request): JsonResponse
    // {
    //     // Data validation
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid login details'
    //         ], 401);
    //     }

    //     $token = $user->createToken('authToken')->plainTextToken;

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Login successful',
    //         'token' => $token
    //     ], 200);
    // }

    // Login for cookie authentication
    public function login(Request $request): JsonResponse
    {
        // Data validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid login details'
        ], 401);
    }

    // Alternative to get /user route 
    public function profile(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'Profile data',
            'user' => $user
        ], 200);
    }

    // Logout for token authentication --- MOBILE
    // public function logout(Request $request): JsonResponse
    // {
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Logged out successfully'
    //     ], 200);
    // }

    // Logout for cookie authentication
    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}
