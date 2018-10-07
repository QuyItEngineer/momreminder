<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;

class DbSettingUpdate
{
    /**
     * DbSettingUpdate constructor.
     */
    public function __construct()
    {
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_STRIPE_TEST_MODE)) {
            $stripeSecret = Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_STRIPE_SECRET_TEST_KEY);
            $stripeKey = Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_STRIPE_PUBLISHABLE_TEST_KEY);
        } else {
            $stripeSecret = Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_STRIPE_SECRET_KEY);
            $stripeKey = Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_STRIPE_PUBLISHABLE_KEY);
        }

        \Config::set('services.stripe.secret', $stripeSecret);
        \Config::set('services.stripe.key', $stripeKey);
        \Config::set('mail.driver', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_PROTOCOL));
        \Config::set('mail.sendmail', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_MAILPATH));
        \Config::set('mail.host', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_SMTP_HOST));
        \Config::set('mail.username', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_SMTP_USER));
        \Config::set('mail.password', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_SMTP_PASS));
        \Config::set('mail.port', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_SMTP_PORT));
        \Config::set('mail.from.address', Setting::getSetting(Setting::MODULE_EMAIL, Setting::SETTING_SENDER_EMAIL));

        return $next($request);
    }
}
