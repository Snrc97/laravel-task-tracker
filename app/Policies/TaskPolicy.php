<?php

namespace App\Policies;

use App\Models\TaskModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Collection;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    /**
     *
     * @param \App\Models\UserModel $user
     * @param Collection<int, \App\Models\TaskModel> $collection
     * @return Collection<int, \App\Models\TaskModel> $collection
     */
    public function authorizeCollection(UserModel $user, $collection )
    {
        $collection = $collection->map(function ($item) use ($user) {
            $project = $item->project()?->first();
            if($project->user_id === $user->id) {
                return $item;
            }
        });

        return $collection;
    }

     public function authorize(UserModel $user, TaskModel $model): bool
     {
        $project = $model->project()?->first();
        $row_user_id = $project?->user_id ?? null;
         return $user->id === $row_user_id;
     }


}
