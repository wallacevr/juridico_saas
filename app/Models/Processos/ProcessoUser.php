<?php

namespace App\models\Processos;

use Illuminate\Database\Eloquent\Model;

class ProcessoUser extends Model
{
    //
    protected $table = 'user_processo';
    protected $fillable = [
       
        'processo_id',
        'user_id',
    ];
}
