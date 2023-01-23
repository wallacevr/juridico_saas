<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Listaprecos extends Model
{
    //
    use SoftDeletes;
    protected $table = "listaprecos";
}
