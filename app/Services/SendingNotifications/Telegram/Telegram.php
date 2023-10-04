<?php

namespace App\Services\SendingNotifications\Telegram;

use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;
use Illuminate\Support\Facades\Log;

class Telegram implements NotifyCodeInterface
{

    public function sendCode(int $code): void
    {
        Log::channel("telegram")->info("Code: {$code}");
    }
}