<?php

namespace App\Containers\AppSection\Post\Policies;

use App\Containers\AppSection\Post\Models\Post;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\Auth\Enums\Role;

class PostPolicy
{
    public function view(User $user, Post $post): bool
    {
        if ($user->role === Role::MANAGER->value) {
            return $post->user && $post->user->manager_id === $user->id;
        }

        if ($user->role === Role::EMPLOYEE->value) {
            return $post->user_id === $user->id;
        }

        return false;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->role === Role::EMPLOYEE->value && $post->user_id === $user->id;
    }

    public function delete(User $user, Post $post): bool
    {
        if ($user->role === Role::MANAGER->value) {
            return $post->user && $post->user->manager_id === $user->id;
        }

        if ($user->role === Role::EMPLOYEE->value) {
            return $post->user_id === $user->id;
        }
        
        return false;
    }
} 