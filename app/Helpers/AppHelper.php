<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

function withValidation(Request $request, $rules, callable $next): JsonResponse
{
    $errors = null;
    try {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            if(count($errors) > 0) {
                $errors = collect($errors)->values()->map(fn($error) => $error[0])->toArray();
                $errors = implode(separator: '<br>', array: $errors);
            }
            else
            {
                $errors = null;
            }

        }
        $validatedData = $validator->validate();
    } catch (\Exception $e) {
    } finally {
        if ($errors != null) {
            return apiResponse(
                [
                    'message' => $errors,
                ],
                401,
            );
        }

        return $next($validatedData);
    }
}