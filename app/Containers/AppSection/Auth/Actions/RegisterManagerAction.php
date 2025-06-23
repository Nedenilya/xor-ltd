<?php

namespace App\Containers\AppSection\Auth\Actions;

use App\Containers\AppSection\User\Tasks\CreateUserTask;
use App\Containers\AppSection\Auth\Enums\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Hash;

final class RegisterManagerAction extends ParentAction
{
    public function __construct(private readonly CreateUserTask $createUserTask) {}

    public function run(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $data['role'] = Role::MANAGER->value;
        $user = $this->createUserTask->run($data);
        
        return $user;
    }
} 