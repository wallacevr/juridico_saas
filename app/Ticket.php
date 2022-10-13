<?php

namespace App;
use App\Collection;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //

    public function products(){
        return $this->belongsToMany(Product::class, 'product_tickets', 'id_ticket', 'id_product');
    }
    public function collections(){
        return $this->belongsToMany(Collection::class, 'collection_tickets', 'id_ticket', 'id_collection');
    }
}
