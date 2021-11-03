<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WishlistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Services\Wishlist\WishListServiceInterface::class,
            \App\Services\Wishlist\WishlistService::class
        );
    }

}
