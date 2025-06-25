<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::post('login', 'AuthenticationController@login');
    Route::post('register', 'AuthenticationController@register');
});

Route::group([
    'prefix' => 'dashboard',
], function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
})->middleware('auth_token');


