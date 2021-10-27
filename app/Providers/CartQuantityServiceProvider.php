<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CartQuantityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            '\App\Services\Cart\CartQuantityServiceInterface',
            '\App\Services\Cart\CartQuantityService'
        );
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
