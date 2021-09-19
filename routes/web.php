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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('products/{product}', [\App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');

Route::get('categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories');
Route::get('categories/{category}', [\App\Http\Controllers\CategoriesController::class, 'show'])->name('categories.show');





Route::namespace('Account')->prefix('account')->name('account')->middleware('auth')->group(function (){

});

Route::namespace('Admin')->prefix('admin')->name('admin')->middleware('auth')->group(function (){

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
