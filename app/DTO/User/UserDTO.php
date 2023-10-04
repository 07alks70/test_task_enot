<?php

namespace App\DTO\User;

class UserDTO
{
    public function __construct(
        public string $name,
        public int $userId,
        public string $password,
        public string $city,
        public string $email,
        public string $citizenship
    ){}

}