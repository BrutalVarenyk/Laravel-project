<?php

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

Auth::routes();

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('products/{product}', [\App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');

Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories');
Route::get('categories/{category}', [\App\Http\Controllers\CategoriesController::class, 'show'])->name('categories.show');

// account/orders/5
Route::namespace('Account')->prefix('account')->name('account')->middleware('auth')->group(function (){

});

// admin/products/create
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth', 'admin')->group(function (){

    Route::get('/', [\App\Http\Controllers\Admin\BoardController::class])->name('home'); // admin.home

    Route::name('orders')->group(function (){
        Route::get('orders', [\App\Http\Controllers\Admin\OrdersController::class, 'index']); // admin.orders
        Route::get('orders/{order}/edit', [\App\Http\Controllers\Admin\OrdersController::class, 'edit'])->name('.edit'); // admin.orders.edit
    });

    Route::name('products')->group(function (){
        Route::get('products', [\App\Http\Controllers\Admin\ProductsController::class, 'index']); //admin.orders
        Route::get('products/{product}/edit', [\App\Http\Controllers\Admin\ProductsController::class, 'edit'])->name('.edit'); // admin.products.edit
        Route::put('products/{product}/update', [\App\Http\Controllers\Admin\ProductsController::class, 'update'])->name('.update'); // admin.products.edit
        Route::delete('products/{product}/delete', [\App\Http\Controllers\Admin\ProductsController::class, 'destroy'])->name('.delete'); // admin.products.edit
    });

});

