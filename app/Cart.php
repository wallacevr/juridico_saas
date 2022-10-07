<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Cart extends Model
{
    //


    public function products(){
        return $this->belongsToMany(Product::class, 'cart_products', 'id_cart', 'id_product');
    }
}
