<?php

namespace App\Repositories\UserEditTaskRepository;

use App\Contracts\Repositories\UserEditTaskRepositoryContract;
use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;
use App\Models\UserEditTask;

class UserEditTaskRepository implements UserEditTaskRepositoryContract
{
    /**
     * Add new UserEditTask
     */
    public function add(UserDTO $userDTO, SendingServiceEnum $enum): UserEditTask
    {
        $userEditTask = UserEditTask::create([
            'name' => $userDTO->name,
            'user_id' => $userDTO->userId,
            'email' => $userDTO->email,
            'city' => $userDTO->city,
            'citizenship' => $userDTO->citizenship,
            'password' => $userDTO->password,
            'confirmation_code' => rand(1000, 9999),
            'sending_service' => $enum->value,
        ]);

        return $userEditTask;
    }

    /**
     * Get UserEditTask by id
     */
    public function getById(int $id): UserEditTask
    {
        return UserEditTask::find($id);
    }
}
