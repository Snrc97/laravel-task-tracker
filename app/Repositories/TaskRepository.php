<?php

namespace App\Repositories;

use App\Models\TaskModel;
use App\Repositories\Interfaces\TaskRepositoryInterface;

/**
 * @template TModel of \App\Models\ProjectModel
 */
class TaskRepository extends RepositoryBase implements TaskRepositoryInterface
{

    public function __construct()
    {
        $this->model = new TaskModel();

    }

}