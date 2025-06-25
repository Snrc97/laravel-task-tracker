<?php

namespace App\Http\Controllers\Api;

use App\Models\ModelBase;
use App\Models\ProjectModel;
use App\Repositories\ProjectRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends ApiControllerBase
{
    use AuthorizesRequests;

    protected ProjectRepository $projectRepository;
    function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->model = $projectRepository->getModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $collection = $this->projectRepository->all();
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
        $validatedData = $request->validate(ProjectModel::rules());
        $model = $this->projectRepository->create($validatedData);
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

        $model = $this->projectRepository->find($id);
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
        $validatedData = $request->validate(ProjectModel::rules());
        /**
         * @var ModelBase $model
         */
        $model = $this->projectRepository->find($id);
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
        $this->authorize('authorize', [auth()->user(), $this->model]);
        $data = $this->projectRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
