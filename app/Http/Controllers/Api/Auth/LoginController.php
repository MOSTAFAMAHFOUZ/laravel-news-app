<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'max:30'],
        ]);

        if (\Auth::attempt($request->only('email', 'password'))) {
            $user = \Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return $this->apiResponse(['token' => $token], 200);
        }
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
