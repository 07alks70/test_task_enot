<?php

namespace App\Actions\User;

use App\Contracts\User\UserEditContract;
use App\Models\UserEditTask;

class UserEditAction implements UserEditContract
{
    public function handler(UserEditTask $userEditTask): bool
    {
        $user = $userEditTask->user;
        if (! empty($userEditTask->name)) {
            $user->name = $userEditTask->name;
        }
        if (! empty($userEditTask->email)) {
            $user->email = $userEditTask->email;
        }
        if (! empty($userEditTask->city)) {
            $user->city = $userEditTask->city;
        }
        if (! empty($userEditTask->citizenship)) {
            $user->citizenship = $userEditTask->citizenship;
        }
        if (! empty($userEditTask->password)) {
            $user->password = $userEditTask->password;
        }

        $userEditTask->status = UserEditTask::STATUS_SUCCESS;
        $userEditTask->save();

        return $user->save();
    }
}
