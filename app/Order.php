<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Order extends Model
{
    //


    public function products(){
        return $this->belongsToMany(Product::class, 'cart_products', 'id_cart', 'id_product');
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }
}
