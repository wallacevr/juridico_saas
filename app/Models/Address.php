<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name', 'postcode', 'address', 'city', 'postalcode', 'number', 'neighborhood', 'state', 'complement', 'state', 'country', 'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
