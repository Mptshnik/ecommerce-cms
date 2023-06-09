<?php

use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', IndexController::class)->name('home');


//middleware
Route::group(['prefix' => 'admin'], function () {
    Route::resource('products', \App\Http\Controllers\Web\ProductController::class)->except(['show']);
    Route::resource('inventories', \App\Http\Controllers\Web\InventorySourceController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Web\CategoryController::class)->except(['show']);
    Route::resource('product-attributes', \App\Http\Controllers\Web\ProductAttributeController::class)->except(['show']);
    Route::resource('attribute-families', \App\Http\Controllers\Web\AttributeFamilyController::class)->except(['show']);
});
