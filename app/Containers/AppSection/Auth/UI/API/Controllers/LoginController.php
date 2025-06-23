<?php

namespace App\Containers\AppSection\Auth\UI\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Ship\Parents\Controllers\ApiController;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends ApiController
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
} 