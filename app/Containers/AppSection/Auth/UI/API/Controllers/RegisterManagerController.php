<?php

namespace App\Containers\AppSection\Auth\UI\API\Controllers;

use App\Containers\AppSection\Auth\Actions\RegisterManagerAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

final class RegisterManagerController extends ApiController
{
    public function __invoke(Request $request, RegisterManagerAction $action): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $user = $action->run($data);
        
        return response()->json(['message' => 'Manager registered successfully', 'user' => $user], 201);
    }
} 