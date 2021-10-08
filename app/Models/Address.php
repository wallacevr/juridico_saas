<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name', 'city', 'postcode','number','neighborhood','state'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
