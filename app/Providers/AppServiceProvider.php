<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use App\Product;
use App\ProductImage;
use File;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::ignoreMigrations();
        Product::deleting(function ($product) {
        
            foreach($product->images as $images)
            {

                deleteImage( $images->image_url, 'catalog');
              
                
            }
                     
            return true;
       });
       
       ProductImage::deleting(function ($image) {
    
            deleteImage( $images->image_url, 'catalog');
                     
        return true;
   });
    }
}
