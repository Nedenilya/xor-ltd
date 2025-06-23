<?php

namespace App\Containers\AppSection\Post\Tasks;

use App\Containers\AppSection\Post\Models\Post;
use App\Containers\AppSection\Post\Policies\PostPolicy;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Gate;

final class ListPostsTask extends ParentTask
{
    public function run(array $filters = []): LengthAwarePaginator
    {
        // Gate::authorize('view', PostPolicy::class);
        
        $query = Post::query();

        if (isset($filters['manager_id'])) {
            $employeeIds = User::where('manager_id', $filters['manager_id'])->pluck('id');
            $query->whereIn('user_id', $employeeIds);
        }

        if (isset($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        return $query->orderByDesc('id')->paginate(10);
    }
} 