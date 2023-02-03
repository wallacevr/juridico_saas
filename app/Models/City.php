<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'city';

    public function state(){
        return $this->belongsTo('App\State');
    }
}
