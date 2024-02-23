<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "type" => ['required', "string", "in:admin,writer"]
        ]);

        $user = User::create($data);
        $token = $user->createToken('API Token')->plainTextToken;
        return $this->apiResponse(["token" => $token]);
    }
}
