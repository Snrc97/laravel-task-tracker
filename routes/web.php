<?php

use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
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



