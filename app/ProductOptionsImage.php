<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptionsImage extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'sort',
        'product_options_id',
        'main'
    ];
    protected $table = "product_options_images";



}
