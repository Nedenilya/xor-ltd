<?php

namespace App\Containers\AppSection\Post\Actions;

use App\Containers\AppSection\Post\Tasks\UpdatePostTask;
use App\Containers\AppSection\Post\Models\Post;
use App\Ship\Parents\Actions\Action as ParentAction;

final class UpdatePostAction extends ParentAction
{
    public function __construct(private readonly UpdatePostTask $task) {}

    public function run(int $postId, array $data): Post
    {
        return $this->task->run($postId, $data);
    }
} 