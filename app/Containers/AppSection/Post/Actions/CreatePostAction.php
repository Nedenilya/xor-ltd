<?php

namespace App\Containers\AppSection\Post\Actions;

use App\Containers\AppSection\Post\Tasks\CreatePostTask;
use App\Containers\AppSection\Post\Models\Post;
use App\Ship\Parents\Actions\Action as ParentAction;

final class CreatePostAction extends ParentAction
{
    public function __construct(private readonly CreatePostTask $task) {}

    public function run(array $data): Post
    {
        return $this->task->run($data);
    }
} 