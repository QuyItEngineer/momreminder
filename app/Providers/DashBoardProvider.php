<?php

namespace App\Providers;

use App\Contracts\DashBoardService;
use Illuminate\Support\ServiceProvider;

class DashBoardProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DashBoardService::class, \App\Services\DashBoardService::class);
    }
}
