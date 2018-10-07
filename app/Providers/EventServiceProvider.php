<?php

namespace App\Providers;

use App\Events\RemindSending;
use App\Events\UserCreditNotEnough;
use App\Listeners\LogNotificationListener;
use App\Listeners\NotificationSentListener;
use App\Listeners\RemindSendingListener;
use App\Listeners\UserCreditNotEnoughListener;
use App\Listeners\UserEventSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationSent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        NotificationSent::class => [
            LogNotificationListener::class,
            NotificationSentListener::class
        ],
        RemindSending::class => [
            RemindSendingListener::class
        ],
        UserCreditNotEnough::class => [
            UserCreditNotEnoughListener::class
        ]
    ];

    protected $subscribe = [
        UserEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
