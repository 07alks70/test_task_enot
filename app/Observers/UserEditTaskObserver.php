<?php

namespace App\Observers;

use App\Contracts\Factories\SendNotificationFactory\SendNotificationFactoryInterface;
use App\Enums\SendingServiceEnum;
use App\Models\UserEditTask;

class UserEditTaskObserver
{
    private SendNotificationFactoryInterface $sendingNotifications;
    public function __construct(SendNotificationFactoryInterface $factorySendingNotifications)
    {
        $this->sendingNotifications = $factorySendingNotifications;
    }

    /**
     * Handle the UserEditTask "created" event.
     */
    public function created(UserEditTask $userEditTask): void
    {
        $this->sendingNotifications->getService(SendingServiceEnum::from($userEditTask->sending_service))->sendCode($userEditTask->confirmation_code);
    }

    /**
     * Handle the UserEditTask "updated" event.
     */
    public function updated(UserEditTask $userEditTask): void
    {
        //
    }

    /**
     * Handle the UserEditTask "deleted" event.
     */
    public function deleted(UserEditTask $userEditTask): void
    {
        //
    }

    /**
     * Handle the UserEditTask "restored" event.
     */
    public function restored(UserEditTask $userEditTask): void
    {
        //
    }

    /**
     * Handle the UserEditTask "force deleted" event.
     */
    public function forceDeleted(UserEditTask $userEditTask): void
    {
        //
    }
}
