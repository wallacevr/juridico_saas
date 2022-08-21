<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColletion extends Model
{
    protected $fillable = [        
        'sort',
        'collection_id',
        'product_id',
    ];
    protected $table = "product_collections";
}
