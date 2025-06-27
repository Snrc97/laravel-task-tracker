<?php

namespace App\Repositories;

use App\Models\ProjectModel;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

/**
 * @template TModel of \App\Models\ProjectModel
 */
class ProjectRepository extends RepositoryBase implements ProjectRepositoryInterface
{

    public function __construct()
    {
        $this->model = new ProjectModel();
    }

}