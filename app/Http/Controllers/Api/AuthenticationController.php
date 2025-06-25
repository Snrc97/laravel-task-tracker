<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends ApiControllerBase
{
    public function register(Request $request): JsonResponse
    {
        return withValidation($request, UserModel::rules('register'), function ($validatedData) use ($request) {


            $user = UserModel::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'], ['cost' => 12]),
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


            $hash_options = ['cost' => 12];
            $userCheck = UserModel::where(['email' => $validatedData['email']])->first();
            if(!Hash::check($validatedData['password'], hashedValue: $userCheck->password."", options: $hash_options))
            {
                return apiResponse(
                    [
                        'message' => __('auth.failed', ['reason' => 'auth.invalid_credentials']),
                    ],
                    401,
                );
            }

            auth()->login($userCheck);
            $token = $userCheck->createToken('auth_token')->plainTextToken;
            return apiResponse(
                [
                    'user' => $userCheck,
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
