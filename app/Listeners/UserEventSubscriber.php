<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 7/24/18
 * Time: 13:41
 */

namespace App\Listeners;


use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     * @param Login $event
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function onUserLogin($event) {
        \Activity::log("Logged: ". request()->ip());
    }

    /**
     * Handle user logout events.
     * @param Logout $event
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function onUserLogout($event) {
        \Activity::log("Logout: ". request()->ip());
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}
