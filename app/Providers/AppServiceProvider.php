<?php

namespace App\Providers;

use App\Actions\User\UserEditAction;
use App\Actions\User\UserEditTaskAddAction;
use App\Contracts\Factories\SendNotificationFactory\SendNotificationFactoryInterface;
use App\Contracts\Repositories\UserEditTaskRepositoryContract;
use App\Contracts\User\UserEditContract;
use App\Contracts\User\UserEditTaskAddContract;
use App\Factories\SendNotificationFactory\SendNotificationFactory;
use App\Models\UserEditTask;
use App\Observers\UserEditTaskObserver;
use App\Repositories\UserEditTaskRepository\UserEditTaskRepository;
use App\Services\SendingNotifications\Factory\Interfaces\FactorySendingNotificationsInterface;
use App\Services\SendingNotifications\Factory\SendingNotifications;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserEditTaskAddContract::class, UserEditTaskAddAction::class);
        $this->app->bind(UserEditContract::class, UserEditAction::class);
        $this->app->bind(UserEditTaskRepositoryContract::class, UserEditTaskRepository::class);
        $this->app->bind(SendNotificationFactoryInterface::class, SendNotificationFactory::class);
        $this->app->bind(FactorySendingNotificationsInterface::class, SendingNotifications::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserEditTask::observe(UserEditTaskObserver::class);
    }
}
