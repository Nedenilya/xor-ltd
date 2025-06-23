<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use App\Containers\AppSection\Auth\Enums\Role;
use App\Containers\AppSection\User\Actions\CreateEmployeeAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

final class CreateEmployeeController extends ApiController
{
    public function __invoke(Request $request, CreateEmployeeAction $action): JsonResponse
    {
        $manager = Auth::user();
        
        if ($manager->role !== Role::MANAGER->value) {
            abort(403, 'Only managers can create employees ' . $manager->role);
        }

        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        $employee = $action->run($data, $manager);

        return response()->json(['message' => 'Employee created successfully', 'user' => $employee], 201);
    }
} 