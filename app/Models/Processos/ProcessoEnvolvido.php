<?php

namespace App\models\Processos;

use Illuminate\Database\Eloquent\Model;

class ProcessoEnvolvido extends Model
{
    protected $table = 'envolvidos_processos';
    protected $fillable = [
       
        'processo_id',
        'envolvido_id',
        'qualificacao_id',
        'created_at',
        'updated_at',
    ];
}
