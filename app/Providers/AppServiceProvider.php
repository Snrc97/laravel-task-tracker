<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            'App\Repositories\Interfaces\RepositoryInterface',
            'App\Http\Controllers\Api\ApiControllerBase'
        );

        $this->app->bind(
            'App\Policies\Interfaces\PolicyInterface',
            'App\Policies\PolicyBase'
        );

        // $this->app->bind(
        //     'App\Repositories\Interfaces\ProjectRepositoryInterface',
        //     'App\Http\Controllers\Api\ProjectController'
        // );

        // $this->app->bind(
        //     'App\Repositories\Interfaces\TaskRepositoryInterface',
        //     'App\Http\Controllers\Api\TaskController'
        // );


        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
