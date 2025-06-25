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
    'controller' => AuthenticationController::class,
], function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'auth_token',
], function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
});


