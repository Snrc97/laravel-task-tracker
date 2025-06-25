<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ModelBase;
use Illuminate\Http\JsonResponse;

class ApiControllerBase extends Controller
{
    /**
     *
     * @var ModelBase
     */
    protected $model;
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function apiResponse($data, $status = 200, $message = null): JsonResponse
    {
        $data = [
            'data' => $data,
            'message' => $message,
            'success' => $status == 200,
            'status' => $status
        ];
        return response()->json($data, $status);
    }
}