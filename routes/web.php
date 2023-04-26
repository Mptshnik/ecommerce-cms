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

Route::resource('products', \App\Http\Controllers\Web\ProductController::class);


Route::group(['prefix' => 'admin'], function () {
    Route::get('/inventories', [\App\Http\Controllers\Web\InventorySourceController::class, 'index'])
        ->name('admin.inventories.index');
    Route::get('/inventories/create', [\App\Http\Controllers\Web\InventorySourceController::class, 'create'])
        ->name('admin.inventories.create');
    Route::get('/inventories/{inventory}/edit', [\App\Http\Controllers\Web\InventorySourceController::class, 'edit'])
        ->name('admin.inventories.edit');
    Route::post('/inventories', [\App\Http\Controllers\Web\InventorySourceController::class, 'store'])
        ->name('admin.inventories.store');
    Route::patch('/inventories/{inventory}/update', [\App\Http\Controllers\Web\InventorySourceController::class, 'update'])
        ->name('admin.inventories.update');
    Route::delete('/inventories/{inventory}', [\App\Http\Controllers\Web\InventorySourceController::class, 'destroy'])
        ->name('admin.inventories.destroy');


    Route::group(['prefix' => 'categories'], function (){
        Route::get('/', [\App\Http\Controllers\Web\CategoryController::class, 'index'])
            ->name('admin.categories.index');
        Route::get('/create', [\App\Http\Controllers\Web\CategoryController::class, 'create'])
            ->name('admin.categories.create');
        Route::get('/{category}/edit', [\App\Http\Controllers\Web\CategoryController::class, 'edit'])
            ->name('admin.categories.edit');
        Route::post('/', [\App\Http\Controllers\Web\CategoryController::class, 'store'])
            ->name('admin.categories.store');
        Route::patch('/{category}/update', [\App\Http\Controllers\Web\CategoryController::class, 'update'])
            ->name('admin.categories.update');
        Route::delete('/{category}', [\App\Http\Controllers\Web\CategoryController::class, 'destroy'])
            ->name('admin.categories.destroy');
    });
});
