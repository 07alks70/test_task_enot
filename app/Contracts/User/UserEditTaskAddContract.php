<?php

namespace App\Contracts\User;

use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;

interface UserEditTaskAddContract
{
    public function handler(UserDTO $userDTO, SendingServiceEnum $sendingServiceEnum): int;
}