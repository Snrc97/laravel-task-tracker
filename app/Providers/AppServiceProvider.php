<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            'App\Repositories\RepositoryInterface',
            'App\Controllers\ApiControllerBase'
        );
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy('App\Models\ProjectModel', 'App\Policies\ProjectPolicy');
        Gate::policy('App\Models\TaskModel', 'App\Policies\TaskPolicy');
    }
}
