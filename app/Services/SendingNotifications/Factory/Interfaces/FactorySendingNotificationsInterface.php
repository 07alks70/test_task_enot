<?php

namespace App\Services\SendingNotifications\Factory\Interfaces;

interface FactorySendingNotificationsInterface
{
    public function makeTelegram(): NotifyCodeInterface;
    public function makeMail(): NotifyCodeInterface;
    public function makeSms(): NotifyCodeInterface;
}