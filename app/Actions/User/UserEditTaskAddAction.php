<?php

namespace App\Actions\User;

use App\Contracts\Repositories\UserEditTaskRepositoryContract;
use App\Contracts\User\UserEditTaskAddContract;
use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;

class UserEditTaskAddAction implements UserEditTaskAddContract
{
    private UserEditTaskRepositoryContract $userEditTaskRepository;

    public function __construct(UserEditTaskRepositoryContract $userEditTaskRepository)
    {
        $this->userEditTaskRepository = $userEditTaskRepository;
    }

    public function handler(UserDTO $userDTO, SendingServiceEnum $sendingServiceEnum): int
    {
        return $this->userEditTaskRepository->add(
            userDTO: $userDTO,
            enum: $sendingServiceEnum
        )->id;
    }
}
