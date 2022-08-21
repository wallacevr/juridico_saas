<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status' => false,
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

}
