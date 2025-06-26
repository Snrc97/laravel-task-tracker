<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Middleware\AuthenticateSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('sanctum/csrf-cookie', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/', function (Request $request) {
    return redirect(route('dashboard'));
});

Route::middleware(['web', AuthenticateSession::class])->group(function () {
    Route::group(
        [
            'prefix' => 'web',
            'controller' => DashboardController::class
        ]
        ,function () {



                Route::group( [
                    'prefix' => 'dashboard',
                    ], function(): void {

                        Route::get('login', 'login')->name('login');
                        Route::get('register', 'register')->name('register');
                        Route::get('logout', 'logout')->name('logout');
                        Route::get('/', 'index')->name('dashboard');
                        Route::get('projects', 'projects')->name('projects');
                        Route::get('tasks', 'tasks')->name('tasks');

                    })
                ;



    });
});






