<?php

namespace App\Containers\AppSection\Post\Tasks;

use App\Containers\AppSection\Post\Models\Post;
use App\Containers\AppSection\Post\Policies\PostPolicy;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\Auth;
use App\Containers\AppSection\Auth\Enums\Role;
use Illuminate\Support\Facades\Gate;

final class DeletePostTask extends ParentTask
{
    public function run(int $postId): void
    {
        Gate::authorize('delete', PostPolicy::class);

        $post = Post::findOrFail($postId);
        $user = Auth::user();

        if ($user->role === Role::MANAGER->value) {
            $employeeIds = $user->employees()->pluck('id')->toArray();

            if (!in_array($post->user_id, $employeeIds)) {
                abort(403, 'Вы не можете удалить этот пост');
            }
        }

        if ($user->role === Role::EMPLOYEE->value) {
            if ($post->user_id !== $user->id) {
                abort(403, 'Вы можете удалять только свои посты');
            }
        }

        $post->delete();
    }
} 