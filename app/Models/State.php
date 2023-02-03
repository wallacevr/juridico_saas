<?php

namespace App\Models;

use App\Models\cliente_log;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'state';

    public function city(){
        return $this->hasMany('App\City');
    }

}
