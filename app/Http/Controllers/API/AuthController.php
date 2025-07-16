<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller

{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Check if a valid token exists
        $existingToken = $user->tokens()
            ->where('name', 'auth_token')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', Carbon::now());
            })
            ->first();

        if ($existingToken) {
    return response()->json([
        'message' => 'Already logged in. You can continue using the token you got when you first logged in.',
    ]);
}

        // Create a new token
        $tokenResult = $user->createToken('auth_token');
        $plainTextToken = $tokenResult->plainTextToken;

        // Set custom expiration (1 day from now)
        $user->tokens()->where('id', $tokenResult->accessToken->id)->update([
            'expires_at' => Carbon::now()->addDay(),
        ]);

        return response()->json([
            'message' => 'Login successful. New token generated.',
            'token' => $plainTextToken,
            'expires_at' => Carbon::now()->addDay(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
