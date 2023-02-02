<?php

namespace App\models\Envolvidos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Envolvido extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
