<?php

use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Store\HomeController;
Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
    'as' => 'store.',
], function () {
    Route::prefix('customer')->group(function () {
        
        Route::middleware('guest:customers')->group(function(){
            //login route
            Route::get('/login','LoginController@login')->name('customer.login');
            Route::post('/login','LoginController@processLogin');
    
            Route::get('/register', 'CustomerController@show')->name('customer.register');
            Route::post('/register/submit', 'CustomerController@submit')->name('customer.register.submit');
        });
    
        Route::middleware('auth:customers')->group(function(){
    
            Route::post('/logout',function(){
                Auth::guard('customers')->logout();
                return redirect()->action([
                    HomeController::class,
                    'index'
                ]);
            })->name('logout');
    
        });
    
    
        
    
        
        
    });
    Route::get('/', 'HomeController@index')->name('store.index');
    
});
