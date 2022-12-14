<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductVariation extends Model
{
    use SoftDeletes;
    protected $fillable = [        
       
        'id_product',
        'id_variation',

    ];
    protected $table = "variations_product";

   
    public function products(){
        return $this->belongsToMany(Product::class);
    }

   }
