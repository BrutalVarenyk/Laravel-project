<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategorylistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Service\GetAllCategoriesServiceInterface', 'App\Service\GetAllCategoriesService');
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
