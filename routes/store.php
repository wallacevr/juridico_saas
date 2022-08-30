<?php

use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::get('/', 'HomeController@index')->name('tenant.home');
Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
    'as' => 'store.',
], function () {
    Route::prefix('customer')->group(function () {

        Route::middleware('guest:customers')->group(function () {
            //login route
            Route::get('/login', 'LoginController@login')->name('customer.login');
            Route::post('/login', 'LoginController@processLogin');

            Route::get('/register', 'CustomerController@show')->name('customer.register');
            Route::post('/register/submit', 'CustomerController@submit')->name('customer.register.submit');
        });

        Route::middleware('auth:customers')->group(function () {

            Route::prefix('dashboard')->group(function () {
                Route::get('/', 'CustomerController@customerDashboard')->name('customer.dashboard');
                Route::get('/addresses', 'CustomerController@customerAddresses')->name('customer.addresses');
            });

            Route::post('/logout', function () {
                Auth::guard('customers')->logout();
                return redirect()->action([
                    HomeController::class,
                    'index',
                ]);
            })->name('logout');
        });
    });

    Route::get('/', 'HomeController@index')->name('store.index');
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/collections/{slug}', 'CollectionController@show')->name('collection.show');
    Route::get('/pagina/{slug}', 'PageController@show')->name('page.show');



    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');


    Route::get('/{product:slug}', 'ProductController@show')->name('product.show');
});
