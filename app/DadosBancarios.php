<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DadosBancarios extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'banco_id','parceiro_id','conta','digconta','agencia','digagencia'
    ];
}
