<?php

namespace App\Policies;

use App\Models\ProjectModel;
use App\Models\UserModel;
use App\Policies\Interfaces\PolicyInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectPolicy extends PolicyBase
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    /**
     *
     * @param UserModel $user
     * @param Collection<int, ProjectModel> $collection
     * @return Collection<int, ProjectModel> $collection
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

     /**
      *
      * @param UserModel $user
      * @param ProjectModel $model
      * @return bool
      */
     public function authorize(UserModel $user, $model): bool
     {
        $row_user_id = $model->user_id ?? null;
         return $user->id === $row_user_id;
     }


}
