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

        Route::redirect('/', '/admin/login/')->middleware('guest:admin')->name('admin.login');

        Route::middleware(['auth', CheckSubscription::class])->group(function () {
            Route::get('/dashboard', 'ApplicationSettingsController@show')->name('admin.dashboad');

            // Collection routes
            Route::get('collections/all', 'CollectionController@getAll')->name('collections.all');
            Route::resource('collections', 'CollectionController');

             // Options routes
             Route::get('options/all/{variation_id}', 'OptionController@getAll')->name('options.all');

            //Customer routes
            Route::get('brands/all', 'BrandController@getAll')->name('brands.all');
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
            // Orders routes
            Route::resource('orders', 'OrderController');

            // Products routes
            Route::resource('products', 'ProductController');
            // Tickets routes
            Route::resource('tickets', 'TicketController');
            // plugins routes
              Route::get('/plugins/{group}', 'PluginController@index')->name('plugins.index');
              Route::get('/plugins/install/{id}', 'PluginController@install')->name('plugins.install');
              Route::post('/plugins/paymentmethods', 'PluginController@paymentplataformstore')->name('paymentplataformstore');


			// Menu routes

			Route::post('menus/getUrl', 'MenuController@getUrl')->name('menus.get-url');
            
            Route::resource('menus', 'MenuController');

            Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');
            Route::get('ckeditor/browse-images', 'CKEditorController@browseImages')->name('ckeditor.browse-images');

            // STORE LAYOUT CONFIGURATIONS
            Route::get('layouts', 'ColorController@index')->name('layout.colors.index');
            Route::post('layouts','ColorController@update')->name('layout.colors.update');
            Route::get('images', 'ImageController@index')->name('layout.image.index');
            Route::post('images', 'ImageController@update')->name('layout.image.update');

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

            
            Route::get('/plugins/whatsappcheckout/setconfig', 'PluginController@whatsappsetconfig')->name('whatssetconfig');
            Route::post('/plugins/whatsappcheckout/storeconfig', 'PluginController@whatsappstoreconfig')->name('whatsstoreconfig');
           
       
        
        });
    });

});
