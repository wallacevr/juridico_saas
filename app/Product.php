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
    public function getImage(){

        $image = '/images/logo_max_commerce.png';
        if($this->image_url){
            $image = tenant_public_path() . '/images/products/' .$this->image_url;
        }
        return $image;
    }
}
