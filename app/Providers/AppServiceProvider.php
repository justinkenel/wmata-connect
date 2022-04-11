<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WmataApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WmataApi::class, function($app) {
            $base_uri = $_ENV["WMATA_BASE_URI"];
            $api_key = $_ENV["WMATA_API_KEY"];
            return new WmataApi($base_uri, $api_key);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
