<?php

namespace App\Contracts\Repositories;

use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;
use App\Models\UserEditTask;

interface UserEditTaskRepositoryContract
{
    /**
     * Add new UserEditTask
     *
     * @param UserDTO $userDTO
     * @param SendingServiceEnum $enum
     * @return UserEditTask
     */
    public function add(UserDTO $userDTO, SendingServiceEnum $enum): UserEditTask;

    /**
     * Get UserEditTask by id
     *
     * @param int $id
     * @return UserEditTask
     */
    public function getById(int $id): UserEditTask;
}