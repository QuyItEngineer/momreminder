<?php

namespace App\Listeners;

use App\Events\RemindSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemindSendingListener
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
     * @param  RemindSending $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
