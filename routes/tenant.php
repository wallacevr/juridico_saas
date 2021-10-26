<?php

use App\Http\Middleware\CheckSubscription;
use App\Http\Middleware\OwnerOnly;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::group([
    'middleware' => ['tenant', PreventAccessFromCentralDomains::class], // See the middleware group in Http Kernel
    'as' => 'tenant.',
], function () {

    $admin = config('nova.path');

    Route::get('/impersonate/{token}', function ($token) {
        return UserImpersonation::makeResponse($token);
    })->name('impersonate');

    Route::prefix($admin)->group(function () {
        Route::any('{user?}/{s?}', function () {
            abort(404);
        });
    });

    Route::post('/ploi/webhook/certificateIssued', 'PloiWebhookController@certificateIssued')->name('ploi.certificate.issued');
    Route::post('/ploi/webhook/certificateRevoked', 'PloiWebhookController@certificateRevoked')->name('ploi.certificate.revoked');

    Route::prefix('admin')->group(function () {
        Auth::routes();

        Route::redirect('/', '/admin/login/')->middleware('guest');

        Route::middleware(['auth', CheckSubscription::class])->group(function () {
            Route::get('/dashboard', 'ApplicationSettingsController@show')->name('admin.dashboad');
            Route::get('/posts', 'PostController@index')->name('posts.index');
            Route::post('/posts', 'PostController@store')->name('posts.store');
            Route::get('/posts/create', 'PostController@create')->name('posts.create');
            Route::get('/posts/{post}', 'PostController@show')->name('posts.show');

            // Collection routes
            Route::resource('collections', 'CollectionController');
            // Brand routes
            Route::resource('brands', 'BrandController');
            // Banner routes
            Route::resource('banners', 'BannerController');
            // Brand routes
            Route::resource('blocks', 'BlockController');
            // Page routes
            Route::resource('pages', 'PageController');
            // Variation routes
            Route::resource('variations', 'VariationController');
            // Option routes
            Route::resource('options', 'OptionController');

            Route::get('configurations', 'ConfigurationController@index')->name('settings.store');
            Route::post('configurations', 'ConfigurationController@update')->name('settings.store.update');

            Route::get('/settings/user', 'UserSettingsController@show')->name('settings.user');
            Route::post('/settings/user/personal', 'UserSettingsController@personal')->name('settings.user.personal');
            Route::post('/settings/user/password', 'UserSettingsController@password')->name('settings.user.password');

            Route::middleware(OwnerOnly::class)->group(function () {
                Route::get('/settings/application', 'ApplicationSettingsController@show')->name('settings.application');
                Route::post('/settings/application/configuration', 'ApplicationSettingsController@storeConfiguration')->name('settings.application.configuration');
                Route::get('/settings/application/invoice/{id}/download', 'DownloadInvoiceController')->name('invoice.download');
            });
        });
    });

});
