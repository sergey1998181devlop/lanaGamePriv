<?php

namespace App\Providers;

use App\club;
use App\Observers\ClubObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (isset($_SERVER['APP_URL']) && \strpos($_SERVER['APP_URL'], 'https') === 0) {
            \URL::forceScheme('https');
        }
        club::observe(ClubObserver::class);
    }
}
