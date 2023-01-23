<?php

namespace App\Http\Livewire\Tenant\Parceiros;

use Livewire\Component;
use App\Parceiro;
use App\Listaprecos;
class CreateParceiro extends Component
{
    public $tppessoa=1;
    public $tpparceiro=1;
    public $nome;
    public $apelido;
    public $cpfcnpj;
    public $listaprecos;
    public $ativo=1;
    public $rg;
    public $emissorrg;
    public $ufrg;
    public $genero;
    public $dtnascimento;
    public $situacaoie;
    public $ie;
    public $im;
    public $listasprecos=[];
    public function render()
    {
    
        return view('livewire.tenant.parceiros.create-parceiro');
    }
    public function mount(){
        $this->listasprecos = Listaprecos::all();
   
    }
    public function store(){
      
        if($this->tppessoa==1){
            $this->validate([
                'cpfcnpj'=>['required','cpf_ou_cnpj'],
                'nome'=>['required','string','max:255'],
                'apelido'=>['string','max:255'],
                'rg'=>['string','max:255'],
                'emissorrg'=>['string','max:255'],
                'ufrg'=>['string','max:2'],
                'dtnascimento'=>['required']
            ]);
        }else{

        }
        try {
            $parceiro= new Parceiro;
            $parceiro->tppessoa = $this->tppessoa;
            $parceiro->tpparceiro = $this->tpparceiro;
            $parceiro->id_listapreco = 1;
            $parceiro->ativo = $this->ativo;
            $parceiro->cpfcnpj =$this->cpfcnpj;
            $parceiro->nome = $this->nome;
            $parceiro->apelido = $this->apelido;
            $parceiro->rg =$this->rg;
            $parceiro->emissorrg = $this->emissorrg;
            $parceiro->ufrg = $this->ufrg;
            $parceiro->genero  = $this->genero;
            $parceiro->dtnascimento = $this->dtnascimento;
            $parceiro->situacaoie = $this->situacaoie;
            $parceiro->ie = $this->ie;
            $parceiro->im = $this->im;
            $parceiro->save();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    public function ff(){
        dd(1);
    }
}
