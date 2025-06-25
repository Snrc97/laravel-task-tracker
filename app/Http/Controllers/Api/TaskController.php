<?php

namespace App\Http\Controllers\Api;

use App\Models\TaskModel;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends ApiControllerBase
{
    use AuthorizesRequests;
    protected TaskRepository $taskRepository;
    function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
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
        $collection = $this->taskRepository->all();
        $collection = $this->authorize('authorizeCollection', [auth()->user(), $collection]);
        return apiResponse(data: $collection->toArray());
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
        $this->authorize('authorize', [auth()->user(), $model]);

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
        $model = $this->taskRepository->find($id);
        $this->authorize('authorize', [auth()->user(), $model]);
        return apiResponse(data: $model);
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
        $this->authorize('authorize', [auth()->user(), $model]);
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
        $this->authorize('authorize', [auth()->user(), $model]);

        $data = $this->taskRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
