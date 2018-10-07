<?php

namespace App\Listeners;

use App\Events\UserCreditNotEnough;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreditNotEnoughListener
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
     * @param  UserCreditNotEnough $event
     * @return void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function handle($event)
    {
        \Activity::logAs(
            "Credit is not enough to send remind [{$event->campaign->name}], please "
            . \Html::link(route('packages.buy_credit'), 'buy')
            . " more credits",
            $event->campaign->createdBy,
            'reminder'
        );
    }
}
