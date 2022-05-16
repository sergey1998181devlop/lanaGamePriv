<?php

namespace App\Providers;

use App\Services\MakeDataConfigurationService;
use Illuminate\Support\ServiceProvider;

class MakeDataConfigurationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MakeDataConfigurationService::class , function ($app){
            return new MakeDataConfigurationService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
