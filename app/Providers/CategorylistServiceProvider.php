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
        $this->app->bind(
            'App\Services\GetAllCategoriesServiceInterface',
            'App\Services\GetAllCategoriesService'
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
