<?php

namespace App\Factories\SendNotificationFactory;

use App\Contracts\Factories\SendNotificationFactory\SendNotificationFactoryInterface;
use App\Enums\SendingServiceEnum;
use App\Services\SendingNotifications\Factory\Interfaces\FactorySendingNotificationsInterface;
use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;

class SendNotificationFactory implements SendNotificationFactoryInterface
{
    private FactorySendingNotificationsInterface $sendingNotifications;
    public function __construct(FactorySendingNotificationsInterface $sendingNotifications)
    {
        $this->sendingNotifications = $sendingNotifications;
    }
    public function getService(SendingServiceEnum $enum): NotifyCodeInterface
    {
        switch ($enum){
            case SendingServiceEnum::TELEGRAM:
                return $this->sendingNotifications->makeTelegram();
            case SendingServiceEnum::EMAIL:
                return $this->sendingNotifications->makeMail();
            default:
                return $this->sendingNotifications->makeSms();
        }
    }
}