<?php

namespace App\Services\SendingNotifications\Factory;

use App\Services\SendingNotifications\Factory\Interfaces\FactorySendingNotificationsInterface;
use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;
use App\Services\SendingNotifications\Mail\Mail;
use App\Services\SendingNotifications\Sms\Sms;
use App\Services\SendingNotifications\Telegram\Telegram;

class SendingNotifications implements FactorySendingNotificationsInterface
{
    public function makeTelegram(): NotifyCodeInterface
    {
        return new Telegram();
    }

    public function makeMail(): NotifyCodeInterface
    {
        return new Mail();
    }

    public function makeSms(): NotifyCodeInterface
    {
        return new Sms();
    }
}
