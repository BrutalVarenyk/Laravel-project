<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Order\Contracts\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepository::class
        );
    }
}
