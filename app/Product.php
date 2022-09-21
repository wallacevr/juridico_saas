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
    public function finalPrice(){
        return $this->special_price>0??$this->price;
    }
    public function formattedFinalPrice(){
        return 'R$ '.number_format($this->special_price,2,',','.');
    }
    public function getImage($size='small'){
        
        $image = null;
        if($this->images()->first()){
            $image = $this->images()->first()->image_url;
        }
        $image = imageCache($image,$size);
        
        return $image;
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function collections(){
        return $this->belongsToMany(Collection::class);
    }
}
