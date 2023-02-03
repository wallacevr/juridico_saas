<?php

namespace App\models\Processos;

use Illuminate\Database\Eloquent\Model;

class ProcessoCliente extends Model
{
    //
    protected $table = 'cliente_processo';
    protected $fillable = [
       
        'processo_id',
        'cliente_id',
        'qualificacao_id'
    ];
}
