<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            Auth::user()->tokens()->delete();

            $token = Auth::user()->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token, 'taskCount' => Auth::user()->task_count, 'username' => Auth::user()->name]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
