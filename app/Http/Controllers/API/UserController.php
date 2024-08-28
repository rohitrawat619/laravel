<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:7|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'msg' => 'User Inserted Successfully',
                'user' => $user
            ]);
        }
        return redirect()->route('students.index');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|min:14',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {

            $user = User::where('email', $request->input('email'))->first();

            if ($user && Hash::check($request->input('password'), $user->password)) {

                //$token = $user->createToken('Personal Access Token')->plainTextToken;

                $token = auth()->attempt($validator->validate());

                $expiration = Carbon::now()->addHour();

                return response()->json([
                    'message' => 'Login successful',
                    'status' => true,
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'expiration' => $expiration->timestamp - now()->timestamp,
                ], 200);
            }
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}