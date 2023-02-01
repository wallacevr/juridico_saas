<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'codbanco','nome'
    ];
}
