<?php

use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api',
], function () {
    Route::post('login', 'AuthenticationController@login')->name('api.login');
    Route::post('register', 'AuthenticationController@register')->name('api.register');
    Route::post('logout', 'AuthenticationController@logout')->name('api.logout');
});

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::group([
        'prefix' => 'dashboard',
        'namespace' => 'App\Http\Controllers\Api',

    ], function () {
        Route::resource('projects', 'ProjectController');
        Route::resource('tasks', 'TaskController');
    })
    ;
});


