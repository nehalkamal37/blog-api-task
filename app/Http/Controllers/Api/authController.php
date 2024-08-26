<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function register(Request $request){
        $validator=$request->validate([
            'name' => 'required|string|max:1255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:7',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            
      ]  );
    
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'user created successfully',
            'token'=>$token,
            'data' => $user
        ], 201);
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login credentials.'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'user loged successfully',
            'token'=>$token,
            'data' => $user
        ], 201);
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully.'], 200);
    }
}
