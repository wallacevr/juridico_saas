<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketProduct extends Model
{
    //
    protected $table = "product_tickets";
    protected $fillable = [
        'created_at',
        'updated_at',
        'id_ticket',
        'id_product'
    ];


}
