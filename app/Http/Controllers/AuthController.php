<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $validatedData = $request->validate([   
            'name' => 'required|max:60',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);

        $user = User::create($validatedData);
        $accessToken = $user->createToken('apiToken')->accessToken;
        return response(['token' => $accessToken]);

    }

    public function login(Request $request) {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! Auth::attempt($credentials)) {
            
            return response()->json(['message' => 'Invalid credentials']);
        }
        Auth::user()->tokens()->delete();
        $accessToken = Auth::user()->createToken('apiToken')->accessToken;

        // return response()->json([ 'data' => [
        //     'access_token' => $accessToken
        // ]]);

        return response()->json(['token' => $accessToken]);
    }

    public function logout(Request $request) {
        Auth::logout();
    }
}
