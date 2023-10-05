<?php

namespace App\Services\SendingNotifications\Mail;

use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;
use Illuminate\Support\Facades\Log;

class Mail implements NotifyCodeInterface
{
    public function sendCode(int $code): void
    {
        Log::channel('email')->info("Code: {$code}");
    }
}
