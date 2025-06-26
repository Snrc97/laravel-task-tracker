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
        $data = $request->only(['email', 'password', 'name']);
        return withValidation($data, UserModel::rules('register'), function ($validatedData) use ($request) {
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
        $data = $request->only(['email', 'password']);
        return withValidation($data, UserModel::rules('login'), function ($validatedData) use ($request) {
            $userCheck = UserModel::where(['email' => $validatedData['email']])->first();

            // $hashed_password = Hash::make($validatedData['password'], ['cost' => 12]);
            // $check_result = Hash::check($validatedData['password'], $hashed_password);
            $attempt_result = auth()->attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']], remember: $request->filled('remember') ?? true);
            if (!$attempt_result) {
                return apiResponse(
                    [
                        'message' => __('auth.failed', ['reason' => 'auth.invalid_credentials']),
                    ],
                    401,
                );
            }

            $token = $userCheck->createToken("api_token");
            $userCheck->update( [
                'api_token' => $token->plainTextToken
            ]);

            $access_token = $token->plainTextToken;
            $request->cookies->set('token', $access_token);
            $request?->session()?->put('token', $access_token);
            $request?->session()?->save();
            return apiResponse(
                [
                    'user' => $userCheck,
                    'token' => $access_token,
                ],
                200,
            );
        });
    }

    public function logout(Request $request): JsonResponse
    {
        authLogout($request);
        return apiResponse(
            [
                'message' => __('auth.logout_success'),
            ],
            200,
        );
    }
}
