<?php

namespace App\Listeners;

use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent $event
     * @return void
     */
    public function handle($event)
    {
        \Log::debug("Notification: [$event->channel][SENT] " . get_class($event->notifiable) . ' - ' . get_class($event->notification));
    }
}
