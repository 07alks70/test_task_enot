<?php

namespace App\Services\SendingNotifications\Sms;

use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;
use Illuminate\Support\Facades\Log;

class Sms implements NotifyCodeInterface
{

    public function sendCode(int $code): void
    {
        Log::channel("sms")->info("Code: {$code}");
    }
}