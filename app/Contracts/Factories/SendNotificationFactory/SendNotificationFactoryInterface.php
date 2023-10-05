<?php

namespace App\Contracts\Factories\SendNotificationFactory;

use App\Enums\SendingServiceEnum;
use App\Services\SendingNotifications\Factory\Interfaces\NotifyCodeInterface;

interface SendNotificationFactoryInterface
{
    public function getService(SendingServiceEnum $enum): NotifyCodeInterface;
}
