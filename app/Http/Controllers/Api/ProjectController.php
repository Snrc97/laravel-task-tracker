<?php

namespace App\Http\Controllers\Api;

use App\Models\ProjectModel;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends ApiControllerBase
{

    function __construct()
    {
        $this->model = new ProjectModel();
    }
}
