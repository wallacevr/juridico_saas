<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
    protected $table = "brands";
    protected $attributes = [
        'status' => false,
    ];
    public function products(){
        return $this->belongsToMany(Product::class)->where('status',1)->orderBy('id','desc');
    }
}
