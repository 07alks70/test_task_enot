<?php

namespace App\Contracts\User;

use App\Models\UserEditTask;

interface UserEditContract
{
    public function handler(UserEditTask $userEditTask): bool;
}
