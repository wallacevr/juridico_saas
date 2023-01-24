<?php

namespace App\Http\Livewire\Tenant\Parceiros;
use Illuminate\Support\Facades\Http;
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
    public $cep=[];
    public $postalcode;
    public $nomeendereco=[];
    public $nameaddress;
    
    public $logradouro=[];
    public $address;
    public $bairro=[];
    public $district;
    public $cidade=[];
    public $city;
    public $uf=[];
    public $state;
    public $numero=[];
    public $number;
    public $complemento=[];
    public $complement;
    public function render()
    {
    
        return view('livewire.tenant.parceiros.create-parceiro');
    }
    public function mount(){
        $this->listasprecos = Listaprecos::all();
        $this->iaddress=0;
    }
    public function store(){
      
        if($this->tppessoa==1){
            $this->validate([
                'cpfcnpj'=>['required','cpf_ou_cnpj','unique:parceiros'],
                'nome'=>['required','string','max:255'],
                'apelido'=>['max:255'],
                'rg'=>['string','max:255'],
                'emissorrg'=>['string','max:255'],
                'ufrg'=>['string','max:2'],
                'dtnascimento'=>['required']
            ]);
        }else{
            $this->validate([
                'cpfcnpj'=>['required','cpf_ou_cnpj','unique:parceiros'],
                'nome'=>['required','string','max:255'],
                'apelido'=>['max:255'],
             
            ]);
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

    public function addaddress(){
        try {
            $this->nomeendereco[count($this->nomeendereco)]=$this->nameaddress;
           $this->cep[count($this->cep)]=$this->postalcode;
           $this->logradouro[count($this->logradouro)]=$this->address;
           $this->bairro[count($this->bairro)]=$this->district;
           $this->cidade[count($this->cidade)]=$this->city;
           $this->uf[count($this->uf)]=$this->state;
           $this->numero[count($this->numero)]=$this->number;
           $this->complemento[count($this->complemento)]=$this->complement;
         
           
        } catch (\Throwable $th) {
                //throw $th;
                dd($th);
        }
       
    }

    public function preencherendereco(){
        try {
            $response = Http::get("http://viacep.com.br/ws/{$this->postalcode}/json/");
            $endereco = $response->json();
            $this->address = "";
           
            $this->district = "";
        
           $this->city="";
            $this->state = "";
            $this->number="";
            $this->complement = "";
            if($endereco!=null){
              
                    
                    
                    $this->address = $endereco['logradouro'];
            
                    $this->district = $endereco['bairro'];
                
                    $this->city = $endereco['localidade'];
                    $this->state = $endereco['uf']; 
      
            }
        } catch (\Throwable $th) {
            //throw $th;
            $this->addError('error', $th->getMessage());
        }

     
    }

    public function destroyaddress($id){
        try {
            unset($this->nomeendereco[$id]);
            unset($this->cep[$id]);
            unset($this->logradouro[$id]);
            unset($this->bairro[$id]);
            unset($this->cidade[$id]);
            unset($this->uf[$id]);
            unset($this->numero[$id]);
            unset($this->complemento[$id]);
        } catch (\Throwable $th) {
            //throw $th;
        }
}
}
