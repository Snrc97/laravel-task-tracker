<?php

namespace App\Policies\Interfaces;

use App\Models\ModelBase;
use App\Models\UserModel;

interface PolicyInterface {
    public function authorize(UserModel $user, mixed $model);
    public function authorizeCollection(UserModel $user, $collection);
}