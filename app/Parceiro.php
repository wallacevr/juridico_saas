<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    //
    use SoftDeletes;

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }
    public function dadosbancarios()
    {
        return $this->hasMany(DadosBancarios::class);
    }
}
