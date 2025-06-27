<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ModelBase;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class ApiControllerBase extends Controller
{
    /**
     *
     * @var ModelBase
     */
    protected $model;

    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->model->load(['project']);
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
        $data = $this->model->all();
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
        $data = $this->model->create($request->all());
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
        $params = $request->all();
        $data = $this->model->find($id);
        return apiResponse(data: $data, params: $params);
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
        $data = $this->model->where('id', $id)->delete();
        return apiResponse(data: $data, status: 204);
    }
}
