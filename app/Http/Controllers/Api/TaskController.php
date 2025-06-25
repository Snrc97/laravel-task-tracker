<?php

namespace App\Http\Controllers\Api;

use App\Models\TaskModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends ApiControllerBase
{
    function __construct()
    {
        $this->model = new TaskModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->model->all();
        return $this->apiResponse(data: $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $this->model->create($request->all());
        return $this->apiResponse(data: $data, status: 201);
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
        $data = $this->model->find($id);
        return $this->apiResponse(data: $data);
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
        $data = $this->model->where('id', $id)->update($request->all());
        return $this->apiResponse(data: $data);
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
        $data = $this->model->where('id', $id)->delete();
        return $this->apiResponse(data: $data, status: 204);
    }
}
