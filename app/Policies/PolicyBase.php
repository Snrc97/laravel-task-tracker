<?php

namespace App\Policies;

use App\Models\UserModel;
use App\Policies\Interfaces\PolicyInterface;

class PolicyBase implements PolicyInterface
{
    public function authorizeCollection(UserModel $user, $collection)
    {
        return $collection;
    }

    public function authorize(UserModel $user, $model): bool
    {
        return true;
    }


}