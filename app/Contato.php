<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'tipo','valor','id_parceiro'
    ];
}
