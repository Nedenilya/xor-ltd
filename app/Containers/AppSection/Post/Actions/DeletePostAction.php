<?php

namespace App\Containers\AppSection\Post\Actions;

use App\Containers\AppSection\Post\Tasks\DeletePostTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class DeletePostAction extends ParentAction
{
    public function __construct(private readonly DeletePostTask $task) {}

    public function run(int $postId): void
    {
        $this->task->run($postId);
    }
} 