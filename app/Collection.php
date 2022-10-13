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
        return $this->belongsToMany(Product::class)->orderBy('id','desc');
    }

    public function tickets(){
        return $this->belongsToMany(Ticket::class, 'product_tickets', 'id_ticket', 'id_product');
    }
}
