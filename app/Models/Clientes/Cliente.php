<?php

namespace App\Models\Clientes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cliente extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
