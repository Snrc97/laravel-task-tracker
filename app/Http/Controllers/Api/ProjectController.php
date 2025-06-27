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
        $params = $request->all();
        $collection = $this->projectRepository->all(['user','tasks']);
        $collection = $this->projectPolicy->authorizeCollection(getUser(), $collection);
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
        $validatedData = $request->validate(ProjectModel::rules());
        $model = $this->projectRepository->create($validatedData);
        $isAuthorized = $this->projectPolicy->authorize(getUser(), $model);
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
        $model = $this->projectRepository->find($id);
        $isAuthorized = $this->projectPolicy->authorize(getUser(), $model);
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
        $validatedData = $request->validate(ProjectModel::rules());
        /**
         * @var ModelBase $model
         */
        $model = $this->projectRepository->find($id);
        $isAuthorized = $this->projectPolicy->authorize(getUser(), $model);
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
        $model = $this->projectRepository->find($id);
        $isAuthorized = $this->projectPolicy->authorize(getUser(), $model);
        if(!$isAuthorized) {
            return apiResponse(data: null, status: 403);
        }
        $data = $this->projectRepository->delete($id);
        return apiResponse(data: $data, status: 204);
    }
}
