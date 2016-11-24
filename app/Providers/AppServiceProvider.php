<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Api;
use App\Models\Observers\ApiObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Api::observe( ApiObserver::class );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
