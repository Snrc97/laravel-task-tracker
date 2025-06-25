<?php

use Illuminate\Http\JsonResponse;

function apiResponse($data = null, $status = 200, $message = null): JsonResponse
{
    $data = [
        'data' => $data,
        'message' => $message,
        'success' => $status == 200,
        'status' => $status,
    ];
    return response()->json($data, $status);
}