<?php

namespace App\Providers;

use App\Contracts\CampaignService;
use App\Contracts\RemindService;
use App\Contracts\CreditCardService;
use App\Contracts\UserService;
use App\Libraries\Bandwidth\Message;
use App\Libraries\Bandwidth\Voice;
use App\Models\Campaign;
use App\Models\Setting;
use App\Observers\CampainObserve;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Observers boot
        Campaign::observe(CampainObserve::class);

//        if(config('app.env') == 'local') {
//            \DB::listen(function ($query) {
//                \Log::debug("[SQL] $query->sql, ".json_encode($query->bindings));
//            });
//        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register services
        $this->app->singleton(UserService::class, \App\Services\UserService::class);
        $this->app->singleton(RemindService::class, \App\Services\RemindService::class);
        $this->app->singleton(CampaignService::class, \App\Services\CampaignService::class);
        $this->app->singleton(CreditCardService::class, \App\Services\CreditCardService::class);
        $this->app->bind('activity', \App\Services\ActivityService::class);

        $this->app->bind(Message::class, function ($app) {
            return new Message(
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_USER_ID),
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_API_TOKEN),
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_API_SECRET)
            );
        });

        $this->app->bind(Voice::class, function ($app) {
            return new Voice(
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_USER_ID),
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_API_TOKEN),
                Setting::getSetting(Setting::MODULE_CORE, Setting::SETTING_API_SECRET)
            );
        });
    }
}
