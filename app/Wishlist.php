<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = "wishlist";
    protected $fillable = [
        'created_at',
        'updated_at',
        'id_product',
        'id_customer'
    ];
}
