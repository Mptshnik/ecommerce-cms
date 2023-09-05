<?php

use App\Http\Controllers\Web\IndexController;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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



Route::get('/admin/login', [\App\Http\Controllers\Web\AuthorizationController::class, 'index'])->name('login');
Route::post('/admin/login', [\App\Http\Controllers\Web\AuthorizationController::class, 'login'])->name('authorize');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/profile/test', [\App\Http\Controllers\Web\UserController::class, 'profile'])->name('profile');
    Route::resource('products', \App\Http\Controllers\Web\ProductController::class)->except(['show']);
    Route::get('/', IndexController::class)->name('home');
    Route::get('/logout', [\App\Http\Controllers\Web\AuthorizationController::class, 'logout'])->name('logout');

    Route::resource('inventories', \App\Http\Controllers\Web\InventorySourceController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Web\CategoryController::class)->except(['show']);
    Route::resource('product-attributes', \App\Http\Controllers\Web\ProductAttributeController::class)->except(['show']);
    Route::resource('attribute-families', \App\Http\Controllers\Web\AttributeFamilyController::class)->except(['show']);
    Route::resource('users', \App\Http\Controllers\Web\UserController::class)->except(['show']);
    Route::resource('customers', \App\Http\Controllers\Web\CustomerController::class)
        ->except(['create', 'store', 'edit', 'update']);

    Route::get('/profile/forgot-password', [\App\Http\Controllers\Web\UserController::class, 'forgotPassword'])
        ->name('profile.forgot-password');
    Route::post('/profile-update', [\App\Http\Controllers\Web\UserController::class, 'updateProfile'])
        ->name('profile.update');
    Route::post('/change-password', [\App\Http\Controllers\Web\UserController::class, 'changePassword'])
        ->name('password.change');
    Route::get('/product-image/{image}/delete', [\App\Http\Controllers\Web\ProductController::class, 'deleteImage'])
        ->name('product-image.delete');

    Route::get('orders', [\App\Http\Controllers\Web\OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('orders/{order}/show', [\App\Http\Controllers\Web\OrderController::class, 'show'])
        ->name('orders.show');
    Route::delete('orders/{order}/delete', [\App\Http\Controllers\Web\OrderController::class, 'destroy'])
        ->name('orders.destroy');
    Route::post('orders/{order}/shipping', [\App\Http\Controllers\Web\OrderController::class, 'orderShipping'])
        ->name('orders.shipping');
    Route::post('orders/{order}/ready', [\App\Http\Controllers\Web\OrderController::class, 'orderReady'])
        ->name('orders.ready');

    Route::post('orders/{order}/shipped', [\App\Http\Controllers\Web\OrderController::class, 'orderShipped'])
        ->name('orders.shipped');
    Route::post('orders/{order}/taken', [\App\Http\Controllers\Web\OrderController::class, 'orderTaken'])
        ->name('orders.taken');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Web\OrderController::class, 'cancel'])
        ->name('orders.cancel');

    Route::get('reviews', [\App\Http\Controllers\Web\ReviewController::class, 'index'])
        ->name('reviews.index');
    Route::get('reviews/{review}/publish', [\App\Http\Controllers\Web\ReviewController::class, 'publish'])
        ->name('reviews.publish');
    Route::get('reviews/{review}/hide', [\App\Http\Controllers\Web\ReviewController::class, 'hide'])
        ->name('reviews.hide');
    Route::get('reviews/{review}/show', [\App\Http\Controllers\Web\ReviewController::class, 'show'])
        ->name('reviews.show');
    Route::delete('reviews/{review}/delete', [\App\Http\Controllers\Web\ReviewController::class, 'destroy'])
        ->name('reviews.destroy');

    Route::get('refunds', [\App\Http\Controllers\Web\OrderController::class, 'cancelledOrders'])
        ->name('refunds.index');
    Route::get('refunds/{order}/show', function (Order $order){
        return view('refunds.show', compact('order'));
    })->name('refunds.show');
    Route::delete('refunds/{order}/delete', function (Order $order){
        $order->delete();

        return redirect()->route('refunds.index')->with('success', "Запись успешно удалена");
    })->name('refunds.destroy');

    Route::get('invoices', [\App\Http\Controllers\Web\InvoiceController::class, 'index'])
        ->name('invoices.index');
    Route::get('invoices/{invoice}/show', [\App\Http\Controllers\Web\InvoiceController::class, 'show'])
        ->name('invoices.show');
    Route::delete('invoices/{invoice}/delete', function (Order $order){
        $order->delete();

        return redirect()->route('invoices.index')->with('success', "Запись успешно удалена");
    })->name('invoices.destroy');
});

Route::get('/', function (){
    return redirect()->route('home');
});

Route::group(['prefix' => 'admin'], function (){

    Route::get('/forgot-password', function () {
        return view('authorization.forgot-password');
    })->middleware('guest')->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->with(['fail' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function (string $token, Request $request) {
        return view('authorization.reset-password', ['token' => $token, 'user_email' => $request->email]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->with(['fail' => __($status)]);
    })->middleware('guest')->name('password.update');

});

