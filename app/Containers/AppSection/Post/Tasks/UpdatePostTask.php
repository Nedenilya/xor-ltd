<?php

namespace App\Containers\AppSection\Post\Tasks;

use App\Containers\AppSection\Post\Models\Post;
use App\Containers\AppSection\Post\Policies\PostPolicy;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\Auth;
use App\Containers\AppSection\Auth\Enums\Role;
use Illuminate\Support\Facades\Gate;

final class UpdatePostTask extends ParentTask
{
    public function run(int $postId, array $data): Post
    {
        // Gate::authorize('update', PostPolicy::class);
        
        $user = Auth::user();
        
        $post = Post::where('id',$postId)->where('user_id', $user->id)->first();
        
        if(!$post || $user->role !== Role::EMPLOYEE->value){
            abort(404, "Post not found");
        }

        $post->update($data);
        
        return $post;
    }
} 