<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
    // 🔹 Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // 🔹 Login and generate JWT token
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    // 🔹 Logout the user (invalidate the token)
    public function logout(Request $request)
    {
    try {
        // Get the token from the request
        $token = $request->bearerToken();

        // Check if token is missing
        if (!$token) {
            return response()->json([
                'error' => 'Unauthorized, no token provided'
            ], 401);
        }

        // Attempt to invalidate the token
        JWTAuth::invalidate($token);

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
        
    } catch (TokenExpiredException $e) {
        // Handle expired token
        return response()->json([
            'error' => 'Token has expired. Please login again.'
        ], 401);

    } catch (TokenInvalidException $e) {
        // Handle invalid token
        return response()->json([
            'error' => 'Token is invalid. Please login again.'
        ], 401);

    } catch (JWTException $e) {
        // Handle any other JWT-related exception
        return response()->json([
            'error' => 'Could not process the token. Please try again.'
        ], 401);
    }
}
    // 🔹 Get the authenticated user
    public function me()
    {
        return response()->json(auth()->user());
    }

    // 🔹 Refresh the token
    public function refresh()
    {
        return response()->json([
            'token' => auth()->refresh(),
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}