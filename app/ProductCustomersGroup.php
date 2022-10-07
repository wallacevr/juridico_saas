<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCustomersGroup extends Model
{
    //
    protected $fillable = [
        'id_customer_group',
        'id_product',
        'qty',
        'price',
        'created_at',
        'updated_at'
  
    ];
    protected $table = "product_customers_groups";
}
