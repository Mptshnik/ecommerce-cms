<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [\App\Http\Controllers\Api\CustomerController::class, 'register'])
    ->name('customer.register')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\Api\CustomerController::class, 'login'])
    ->name('customer.login')->middleware('guest');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/customer', [\App\Http\Controllers\Api\CustomerController::class, 'getAuthorizedCustomer'])
        ->name('customer.current');
    Route::get('/logout', [\App\Http\Controllers\Api\CustomerController::class, 'logout'])
        ->name('customer.logout');

    Route::get('/reviews', [\App\Http\Controllers\Api\ReviewController::class, 'index'])
        ->name('reviews.index');
    Route::post('/reviews/{product_id}', [\App\Http\Controllers\Api\ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::post('/reviews/{review}/edit', [\App\Http\Controllers\Api\ReviewController::class, 'update'])
        ->name('reviews.update');
    Route::get('/reviews/{review}/delete', [\App\Http\Controllers\Api\ReviewController::class, 'destroy'])
        ->name('reviews.destroy');


    Route::get('/cart/{orderId}', [CartController::class, 'index']);
    Route::get('/items/{productId}/add-to-cart', [CartController::class, 'addToCart']);
    Route::post('/order/{order}/confirm', [OrderController::class, 'confirm']);
});
