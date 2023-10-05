<?php

namespace App\Contracts\Repositories;

use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;
use App\Models\UserEditTask;

interface UserEditTaskRepositoryContract
{
    /**
     * Add new UserEditTask
     */
    public function add(UserDTO $userDTO, SendingServiceEnum $enum): UserEditTask;

    /**
     * Get UserEditTask by id
     */
    public function getById(int $id): UserEditTask;
}
