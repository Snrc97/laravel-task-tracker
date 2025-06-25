<?php

namespace App\Http\Controllers\Api;

use App\Models\ModelBase;
use App\Models\ProjectModel;
use App\Policies\ProjectPolicy;
use App\Repositories\ProjectRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends ApiControllerBase
{
    use AuthorizesRequests;

    protected ProjectRepository $projectRepository;
    protected ProjectPolicy $projectPolicy;
    function __construct(ProjectRepository $projectRepository, ProjectPolicy $projectPolicy)
    {
        $this->projectRepository = $projectRepository;
        $this->projectPolicy = $projectPolicy;
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
        $collection = $this->projectPolicy->authorizeCollection(getUser(), $collection);
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
        $this->projectPolicy->authorize(getUser(), $model);
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
        $this->projectPolicy->authorize(getUser(), $model);
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
        $this->projectPolicy->authorize(getUser(), $model);
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
        $model = $this->projectRepository->find($id);
        $this->projectPolicy->authorize(getUser(), $model);
        $data = $this->projectRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
