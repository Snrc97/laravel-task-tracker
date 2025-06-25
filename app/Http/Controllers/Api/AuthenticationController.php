<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends ApiControllerBase
{
    public function register(Request $request): JsonResponse
    {
        return withValidation($request, UserModel::rules('register'), function ($validatedData) use ($request) {


            $user = UserModel::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return apiResponse(
                [
                    'user' => $user,
                    'token' => $token,
                ],
                201,
            );
        });

    }

    public function login(Request $request): JsonResponse
    {
        return withValidation($request, UserModel::rules('login'), function ($validatedData) use ($request) {
            if (!auth()->attempt($validatedData)) {
                return apiResponse(
                    [
                        'message' => __('auth.failed'),
                    ],
                    401,
                );
            }

            $userCheck = UserModel::where(['email' => $validatedData['email'], 'password' => $validatedData['password']])->first();

            if (!$userCheck) {
                return apiResponse(
                    [
                        'message' => __('auth.failed', ['reason' => __('auth.invalid_credentials')]),
                    ],
                    401,
                );
            }

            $user = auth()->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return apiResponse(
                [
                    'user' => $user,
                    'token' => $token,
                ],
                200,
            );
        });



    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return apiResponse(
            [
                'message' => __('auth.logout_success'),
            ],
            200,
        );
    }
}
