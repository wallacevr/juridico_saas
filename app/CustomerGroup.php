<?php

namespace App;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $table = "customers_group";

    public function customers(){

        return $this->hasMany(Customer::class);
    }

}
