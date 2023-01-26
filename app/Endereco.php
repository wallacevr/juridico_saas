<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'nomeendereco','cep','logradouro','bairro','cidade','uf','numero','complemento','id_parceiro'
    ];
}
