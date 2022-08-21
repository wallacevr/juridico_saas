<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status' => false,
    ];

    public function formattedPrice(){
        return 'R$ '.number_format($this->price,2,',','.');
    }
    public function formattedSpecialPrice(){
        return 'R$ '.number_format($this->special_price,2,',','.');
    }
    public function getImage(){

        $image = '/images/no-image.jpg';
        if($this->images()->first()){
            $image = tenant_public_path() . '/catalog/' .$this->images()->first()->image_url;
        }
        return $image;
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function collections(){
        return $this->belongsToMany(Collection::class);
    }
}
