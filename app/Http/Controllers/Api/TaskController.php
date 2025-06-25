<?php

namespace App\Http\Controllers\Api;

use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends ApiControllerBase
{
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
        $data = $this->taskRepository->all();
        return apiResponse(data: $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->taskRepository->create($request->all());
        return apiResponse(data: $data, status: 201);
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
        $data = $this->taskRepository->find($id);
        return apiResponse(data: $data);
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
        $data = $this->taskRepository->find($id)->update($request->all());
        return apiResponse(data: $data);
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
        $data = $this->taskRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
