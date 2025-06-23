<?php

namespace App\Containers\AppSection\Post\Tasks;

use App\Containers\AppSection\Post\Models\Post;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class CreatePostTask extends ParentTask
{
    public function run(array $data): Post
    {
        return Post::create($data);
    }
} 