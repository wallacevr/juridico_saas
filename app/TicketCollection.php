<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCollection extends Model
{
    //
    protected $table = "collection_tickets";
    protected $fillable = [
        'created_at',
        'updated_at',
        'id_ticket',
        'id_collection'
    ];
}
