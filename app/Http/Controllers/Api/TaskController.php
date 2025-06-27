<?php

namespace App\Http\Controllers\Api;

use App\Models\TaskModel;
use App\Policies\TaskPolicy;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends ApiControllerBase
{
    use AuthorizesRequests;
    protected TaskRepository $taskRepository;
    protected TaskPolicy $taskPolicy;
    function __construct(TaskRepository $taskRepository, TaskPolicy $taskPolicy)
    {
        $this->taskRepository = $taskRepository;
        $this->taskPolicy = $taskPolicy;
        $this->model = $taskRepository->getModel();

    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $params = $request->all();
        $collection = $this->model->all(['project', 'project.user']);
        $collection = $this->taskPolicy->authorizeCollection(getUser(), $collection);
        $collection = collect($collection);
        $data = $collection->toArray();
        $collection = null;
        datatableDataProcess($data, $params);
        return apiResponse(data: $data, params: $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate(TaskModel::rules());
        $model = $this->taskRepository->create($validatedData);
        $isAuthorized = $this->taskPolicy->authorize(getUser(), $model);
        if(!$isAuthorized) {
            return apiResponse(data: null, status: 403);
        }
        return apiResponse(data: $model, status: 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id): JsonResponse
    {
        $params = $request->all();
        $model = $this->taskRepository->find($id);
        $isAuthorized = $this->taskPolicy->authorize(getUser(), $model);
        if(!$isAuthorized) {
            return apiResponse(data: null, status: 403);
        }
        return apiResponse(data: $model, params: $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate(TaskModel::rules());
        $model = $this->taskRepository->find($id);
        $isAuthorized = $this->taskPolicy->authorize(getUser(), $model);
        if(!$isAuthorized) {
            return apiResponse(data: null, status: 403);
        }
        $model = $model->update($validatedData);
        return apiResponse(data: $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        $model = $this->taskRepository->find($id);
        $isAuthorized = $this->taskPolicy->authorize(getUser(), $model);
        if(!$isAuthorized) {
            return apiResponse(data: null, status: 403);
        }

        $data = $this->taskRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
