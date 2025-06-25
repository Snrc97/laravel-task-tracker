<?php

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





Route::group([
'prefix' => 'web',
    'middleware' => 'authenticate_session',
    'controller' => DashboardController::class
], function() {
    Route::get('{action}/{params?}', function( Request $request, $action, $params = null) {
        $controller = new DashboardController();
        return $controller->{$action}($request, $params);
    })
    ->where('params', '.*');
});



