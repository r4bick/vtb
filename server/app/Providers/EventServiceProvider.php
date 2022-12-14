<?php

namespace App\Providers;

use App\Events\DepartureEvents\DepartureCreatedEvent;
use App\Events\OrderEvents\OrderCreatingEvent;
use App\Events\TaskEvents\TaskCreatingEvent;
use App\Events\TaskEvents\TaskDepartureCreatedEvent;
use App\Events\TaskEvents\TaskUpdatedToCompletedStageEvent;
use App\Events\TaskEvents\TaskUserCreatedEvent;
use App\Events\UserEvents\UserCreatedEvent;
use App\Listeners\CreateWalletListener;
use App\Listeners\GenerateUuidListener;
use App\Listeners\OrderListeners\PurchaseProductListener;
use App\Listeners\OrderListeners\SetPriceProductListener;
use App\Listeners\TaskListeners\BonusCreditingListener;
use App\Listeners\TaskListeners\TaskTakenPartListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreatedEvent::class => [
            CreateWalletListener::class,
        ],
        DepartureCreatedEvent::class => [
            CreateWalletListener::class,
        ],
        TaskUserCreatedEvent::class => [
            TaskTakenPartListener::class,
        ],
        TaskDepartureCreatedEvent::class => [
            TaskTakenPartListener::class,
        ],
        TaskCreatingEvent::class => [
            GenerateUuidListener::class,
        ],
        TaskUpdatedToCompletedStageEvent::class => [
            BonusCreditingListener::class,
        ],
        OrderCreatingEvent::class => [
            GenerateUuidListener::class,
            SetPriceProductListener::class,
            PurchaseProductListener::class,
        ]
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
