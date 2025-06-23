<?php

namespace App\Containers\AppSection\Post\Actions;

use App\Containers\AppSection\Post\Tasks\ListPostsTask;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ListPostsAction extends ParentAction
{
    public function __construct(private readonly ListPostsTask $task) {}

    public function run(array $filters = []): LengthAwarePaginator
    {
        return $this->task->run($filters);
    }
} 