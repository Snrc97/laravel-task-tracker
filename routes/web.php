<?php

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return redirect(route('dashboard'));
});

Route::group([
    'prefix' => 'web',
        'controller' => DashboardController::class
    ], function() {

        Route::group( [
            'prefix' => 'dashboard',
            ], function() {
                Route::get('login', 'login')->name('login');
                Route::get('register', 'register')->name('register');
                Route::get('logout', 'logout')->name('logout');

                Route::group([
                    'middleware' => 'auth:sanctum',
                ], function() {
                    Route::get('/', 'index')->name('dashboard');
                    Route::get('projects', 'projects')->name('projects');
                    Route::get('tasks', 'tasks')->name('tasks');
                });

            })
        ;

    })
    ;




