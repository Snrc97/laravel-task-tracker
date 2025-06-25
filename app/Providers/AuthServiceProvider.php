<?php
namespace App\Providers;

use App\Models\ProjectModel;
use App\Models\TaskModel;

use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ProjectModel::class => ProjectPolicy::class,
        TaskModel::class => TaskPolicy::class,
    ];

    public function boot()
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        $this->registerPolicies();
    }
}
