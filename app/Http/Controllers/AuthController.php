<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'profile_image' => 'string|max:255|nullable',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'family' => $validatedData['family'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $user_type= $user->is_rapairman ? 'repairman': 'customer';
        $user_type= $user->is_admin ? 'admin' : 'customer';


        if ($user->is_admin)
            $token = $user->createToken('auth_token',['is_admin'])->plainTextToken;
        elseif ($user->is_repairman)
            $token = $user->createToken('auth_token',['is_admin'])->plainTextToken;
        else
            $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user_type' => $user_type
        ]);
    }
    public function me(Request $request)
    {
        return $request->user();
    }
}
