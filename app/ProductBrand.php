<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productbrand extends Model
{
    protected $fillable = [        
        'sort',
        'brand_id',
        'product_id',
    ];
    protected $table = "product_brands";
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
