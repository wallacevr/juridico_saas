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

   
    Route::get('/', 'HomeController@index')->name('tenant.home');
    Route::post('/ploi/webhook/certificateIssued', 'PloiWebhookController@certificateIssued')->name('ploi.certificate.issued');
    Route::post('/ploi/webhook/certificateRevoked', 'PloiWebhookController@certificateRevoked')->name('ploi.certificate.revoked');

    Route::prefix('admin')->group(function () {
        Auth::routes();

        Route::redirect('/', '/admin/login/')->middleware('guest');

        Route::middleware(['auth', CheckSubscription::class])->group(function () {
            Route::get('/dashboard', 'ApplicationSettingsController@show')->name('admin.dashboad');
          
            // Collection routes
            Route::resource('collections', 'CollectionController');
            //Customer routes
            Route::resource('customers', 'CustomerController');
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

            // Products routes
            Route::resource('products', 'ProductController');


			// Menu routes

			Route::post('menus/getUrl', 'MenuController@getUrl')->name('menus.get-url');
            Route::resource('menus', 'MenuController');

            Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');
            Route::get('ckeditor/browse-images', 'CKEditorController@browseImages')->name('ckeditor.browse-images');

            Route::get('configurations', 'ConfigurationController@index')->name('settings.store');
            Route::post('configurations', 'ConfigurationController@update')->name('settings.store.update');

            Route::get('/settings/user', 'UserSettingsController@show')->name('settings.user');
            Route::post('/settings/user/personal', 'UserSettingsController@personal')->name('settings.user.personal');
            Route::post('/settings/user/password', 'UserSettingsController@password')->name('settings.user.password');

            Route::resource('customers/groups', 'CustomerGroupController');

            Route::middleware(OwnerOnly::class)->group(function () {
                Route::get('/settings/application', 'ApplicationSettingsController@show')->name('settings.application');
                Route::post('/settings/application/configuration', 'ApplicationSettingsController@storeConfiguration')->name('settings.application.configuration');
                Route::get('/settings/application/invoice/{id}/download', 'DownloadInvoiceController')->name('invoice.download');
            });

            Route::post('/upload', 'UploadController@submit')->name('upload.upload');
            Route::post('/ajax_remove_file', 'UploadController@removeFile');
        });
    });

});
