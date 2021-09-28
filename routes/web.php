<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/en');

Route::prefix(\App\Service\Localization\LocalizationService::localize())->name('lang.')->group(function(){
    Auth::routes();

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('products', [\App\Http\Controllers\ProductsController::class, 'index'])
        ->name('products');
    Route::get('products/{product}', [\App\Http\Controllers\ProductsController::class, 'show'])
        ->name('products.show');

    Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])
        ->name('categories');
    Route::get('categories/{category}', [\App\Http\Controllers\CategoriesController::class, 'show'])
        ->name('categories.show');

// account/orders/5
    Route::namespace('Account')->prefix('account')->name('account.')->middleware('auth')
        ->group(function (){

        Route::get('/', [\App\Http\Controllers\Account\UserController::class, 'index'])
            ->name('home'); // lang.account.home

        Route::get('edit', [\App\Http\Controllers\Account\UserController::class, 'edit'])
            ->name('edit'); // lang.account.edit

        Route::get('update', [\App\Http\Controllers\Account\UserController::class, 'update'])
            ->name('update'); // lang.account.update

        Route::get('{user}/show', [\App\Http\Controllers\Account\UserController::class, 'show'])
            ->name('show'); // lang.account.update

    });

    Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth', 'admin')
        ->group(function (){

        Route::get('/', '\App\Http\Controllers\Admin\BoardController')
            ->name('home'); // lang.admin.home

        Route::name('orders')->group(function (){
            Route::get('orders', [\App\Http\Controllers\Admin\OrdersController::class, 'index']); // lang.admin.orders
            Route::get('orders/{order}/edit', [\App\Http\Controllers\Admin\OrdersController::class, 'edit'])
                ->name('.edit'); // lang.admin.orders.edit
            Route::get('orders/{order}/show', [\App\Http\Controllers\Admin\OrdersController::class, 'show'])
                ->name('.show'); // lang.admin.orders.show
        });

        Route::name('products')->group(function (){
            Route::get('products', [\App\Http\Controllers\Admin\ProductsController::class, 'index']); //admin.products
            Route::get('products/{product}/edit', [\App\Http\Controllers\Admin\ProductsController::class, 'edit'])
                ->name('.edit'); // lang.admin.products.edit
            Route::put('products/{product}/update', [\App\Http\Controllers\Admin\ProductsController::class, 'update'])
                ->name('.update'); // lang.admin.products.edit
            Route::delete('products/{product}/delete', [\App\Http\Controllers\Admin\ProductsController::class, 'destroy'])
                ->name('.delete'); // lang.admin.products.edit
            Route::get('products/new', [\App\Http\Controllers\Admin\ProductsController::class, 'create'])
                ->name('.create'); // lang.admin.products.create
            Route::post('products', [\App\Http\Controllers\Admin\ProductsController::class, 'store'])
                ->name('.store'); // lang.admin.products.store

        });

    });
});

