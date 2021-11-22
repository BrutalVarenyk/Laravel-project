<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::get('products', [\App\Http\Controllers\Api\V1\ProductsController::class, 'index']);

Route::namespace('api')->group(function() {

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');

    Route::namespace('v1')->prefix('v1')->group(function () {
        Route::get('products', [\App\Http\Controllers\Api\V1\ProductsController::class, 'index'])
            ->name('products');
        Route::get('products/{product}', [\App\Http\Controllers\Api\V1\ProductsController::class, 'show'])
            ->name('products.show');

        Route::group(['middleware' => ['auth:sanctum']], function () {

            Route::group(['middleware' => ['admin']], function (){
               Route::post('categories', [\App\Http\Controllers\Api\V1\Admin\CategoriesController::class, 'store'])
                   ->name('categories.store');
               Route::delete('categories/{category}', [\App\Http\Controllers\Api\V1\Admin\CategoriesController::class, 'delete'])
                   ->name('categories.store');
            });

        });
    });
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
