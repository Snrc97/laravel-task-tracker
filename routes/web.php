<?php

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $controller = new DashboardController();
        return $controller->index($request);
});

Route::group([
'prefix' => 'web',
    'middleware' => 'authenticate_session',
    'controller' => DashboardController::class
], function() {
    Route::get('dashboard/{action?}/{params?}', function( Request $request, $action = 'index', $params = null) {
        $controller = new DashboardController();
        return $controller->{$action}($request, $params);
    })
    ->where('params', '.*');
});



