<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'sort',
        'product_id'
    ];
    protected $table = "product_images";

}
