<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Middleware\AuthMiddleware;
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
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'auth:sanctum',

], function () {
    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');
})
;


