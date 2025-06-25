<?php

namespace App\Policies;

use App\Models\ProjectModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Collection;

class ProjectPolicy
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
     * @param Collection<int, \App\Models\ProjectModel> $collection
     * @return Collection<int, \App\Models\ProjectModel> $collection
     */
    public function authorizeCollection(UserModel $user, $collection )
    {
        $collection = $collection->map(function ($item) use ($user) {
            if($item->user_id === $user->id) {
                return $item;
            }
        });

        return $collection;
    }

     public function authorize(UserModel $user, ProjectModel $model): bool
     {
        $row_user_id = $model->user_id ?? null;
         return $user->id === $row_user_id;
     }


}
