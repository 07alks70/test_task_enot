<?php

namespace App\Services\SendingNotifications\Factory\Interfaces;

interface NotifyCodeInterface
{
    public function sendCode(int $code): void;
}