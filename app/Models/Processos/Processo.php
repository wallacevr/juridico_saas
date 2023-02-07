<?php

namespace App\models\Processos;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Varas\Varas;
use App\Models\Foros\Foro;
use App\Models\Acoes\Acao;
use App\Models\Historicos\Historicos;
use App\Models\Instancias\Instancia;
class Processo extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
       
   
        'titulo',
        'instancia_id',
        'numero',
        'juizo',
    
        'acao_id',
        'vara_id',
       'foro_id',
        
        'linktribunal',
        'objeto',
        'valorcausa',
       'dtdistribuicao',
        'valorcondenacao',
        'observacoes',
       'porcentagemhoronarios',
       'horonarios',
       'updated_at',
       'created_at'
    ];

    public function clientes()
    {
       
            return $this->belongsToMany('App\Models\Clientes\Cliente')->withPivot(['qualificacao_id']);
      

    
    }
    public function envolvidos()
    {
       
            return $this->belongsToMany('App\Models\Envolvidos\Envolvido','envolvidos_processos','processo_id',"envolvido_id")->withPivot(['qualificacao_id']);
      

    
    }
    public function responsaveis()
    {
       
            return $this->belongsToMany('App\User','user_processo','processo_id',"user_id");
      

    
    }
    public function instancia()
    {
        return $this->BelongsTo(Instancia::class);
    }
    public function vara()
    {
        return $this->BelongsTo(Varas::class);
    }
    public function foro()
    {
        return $this->BelongsTo(Foro::class);
    }
    public function acao()
    {
        return $this->BelongsTo(Acao::class);
    }
    public function historico()
    {
        return $this->hasMany(Historicos::class)->orderBy('data','desc');
    }
    public function processo()
    {
        return $this->hasMany(Processo::class);
    }
    
    public function recursos()
    {
        return $this->hasMany(Processo::class, 'principal_recurso_id', 'id');
    }
    public function desdobramentos()
    {
        return $this->hasMany(Processo::class, 'principal_desdobramento_id', 'id');
    }
}
