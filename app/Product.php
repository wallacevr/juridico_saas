<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
            $image ='/tenant/'. tenant('id') .'/images/catalog/'. $this->id .'/'.  $this->images()->first()->image_url;

        }
       // $image = imageCache($image,$size);

        return $image;
    }

    public function images(){
        return $this->hasMany(ProductImage::class)->orderBy('sort');
    }

    public function collections(){
        return $this->belongsToMany(Collection::class,'collection_product', 'product_id', 'collection_id');
    }
    public function brands(){
        return $this->belongsToMany(Brand::class,'brand_product', 'product_id', 'brand_id');
    }
    public function variations(){
        return $this->belongsToMany(Variation::class, 'variations_product', 'product_id', 'variation_id');
    }
    public function options(){
        return $this->belongsToMany(Option::class, 'product_options', 'id_product', 'id_options')->withPivot('nivel','price','qty_stock')->where('nivel',0);
    }
    public function tickets(){
        return $this->belongsToMany(Ticket::class, 'product_tickets', 'id_product', 'id_ticket');
    }
/*
    public function variations(){
        return DB::table('product_options')
            ->where('id_product','=',$this->id)
            ->join('options', 'product_options.id_options', '=', 'options.id')
            ->get();
    }
*/
}
