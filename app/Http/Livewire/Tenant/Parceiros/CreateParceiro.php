<?php

namespace App\Http\Livewire\Tenant\Parceiros;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Parceiro;
use App\Listaprecos;
use App\Banco;
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
    public $emailnfe;
    public $issretido;
    public $consumidorfinal;
    public $produtorrural;
    public $tab;
    public $contatos=[];
    public $tpcontatos=[];
    public $email;
    public $telefone;
    public $celular;
    public $site;
    public $icontato; 
    public $limitecliente;
    public $limitefornecedor;       
    public $bancos= [];
    public $bancoid;
    public $conta;
    public $digconta;
    public $agencia;
    public $digagencia;
    public $bancosid=[];
    public $nomebancos=[];
    public $contas=[];
    public $digcontas=[];
    public $agencias=[];
    public $digagencias=[];
    public function render()
    {
       
        return view('livewire.tenant.parceiros.create-parceiro');
    }
    public function mount(){
        $this->listasprecos = Listaprecos::all();
        $this->iaddress=0;
        $this->bancos =  Banco::all();
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
                'dtnascimento'=>['required'],
                'limitecliente'=>['numeric'],
                'limitefornecedor'=>['numeric'],
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
            $parceiro->emailnfe = $this->emailnfe;
          
          
            $parceiro->limitecliente = $this->limitecliente;
            $parceiro->limitefornecedor = $this->limitefornecedor;
            if($this->produtorrural!=null){
                $parceiro->produtorrural = $this->produtorrural;
            }else{
                $parceiro->produtorrural = 0;
            }
            if($this->consumidorfinal!=null){
                $parceiro->consumidorfinal = $this->consumidorfinal;
            }else{
                $parceiro->consumidorfinal = 0;
            }    
            if($this->issretido!=null){
                $parceiro->issretido = $this->issretido;
            }else{
                $parceiro->issretido = 0;
            } 
            $parceiro->save();
            foreach($this->cep as $key=>$value){
                $parceiro->enderecos()->create([
                    'nomeendereco' => $this->nomeendereco[$key],
                    'cep' => $this->cep[$key],
                    'logradouro' => $this->logradouro[$key],
                    'bairro' => $this->bairro[$key],
                     'cidade' => $this->cidade[$key],
                    'uf' => $this->uf[$key],
                    'numero' => $this->numero[$key],
                   'complemento' => $this->complemento[$key]
                ]);
            }
            foreach($this->contatos as $key=>$value){
                $parceiro->contatos()->create([
                    'tipo' => $this->tpcontatos[$key],
                    'valor' => $this->contatos[$key],
                   
                ]);
            }
            foreach($this->bancosid as $key=>$value){
                $parceiro->dadosbancarios()->create([
                    'banco_id' => $this->bancosid[$key],
                    'conta' => $this->contas[$key],
                    'digconta' => $this->digcontas[$key],
                    'agencia' => $this->agencias[$key],
                    'digagencia' => $this->digagencias[$key],
                   
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function addcontato($tpcontato){
       
        switch ($tpcontato) {
            case "Celular":
                $this->validate([
                    'celular' => ['required','celular_com_ddd']
                ]);
                break;
            case "Telefone":
                $this->validate([
                    'telefone' => ['required','telefone_com_ddd']
                ]);
                break;
            case "Email":
                $this->validate([
                    'email' => ['required','email']
                ]);
                break;
            case "Site":
                $this->validate([
                    'site' => ['required','url']
                ]);
                break;
        }
       
        try {
            
            switch ($tpcontato) {
                case "Celular":
                    $this->tpcontatos[count($this->contatos)] ="Celular";
                    $this->contatos[count($this->contatos)]=$this->celular;
                    $this->celular="";
                    break;
                case "Telefone":
                    $this->tpcontatos[count($this->contatos)] ="Telefone";
                    $this->contatos[count($this->contatos)]=$this->telefone;
                    $this->telefone="";
                    break;
                case "Email":
                    $this->tpcontatos[count($this->contatos)] ="Email";
                    $this->contatos[count($this->contatos)]=$this->email;
                    $this->email="";
                    break;
                case "Site":
                    $this->tpcontatos[count($this->contatos)]="Site";
                    $this->contatos[count($this->contatos)]=$this->site;
                    $this->site="";
                    break;
            }
           
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function addbancarios(){
        $this->validate([
            'bancoid'=>['required'],
            'conta'=>['required'],
            'agencia'=>['required']
        ]);
        try {

            $this->bancosid[count($this->bancosid)] = $this->bancoid;
            $banco= Banco::find($this->bancoid);
            $this->nomebancos[count($this->nomebancos)] = $banco->nome;
            $this->contas[count($this->contas)] = $this->conta;
            $this->digcontas[count($this->digcontas)] = $this->digconta;
            $this->agencias[count($this->agencias)] = $this->agencia;
            $this->digagencias[count($this->digagencias)] = $this->digagencia;
            $this->conta ="";
            $this->digconta="";
            $this->agencia="";
            $this->digagencia="";
           
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
         
           $this->nomeendereco[0]="";
           $this->cep[0]="";
           $this->logradouro[0]="";
           $this->bairro[0]="";
           $this->cidade[0]="";
           $this->uf[0]="";
           $this->numero[0]="";
           $this->complemento[0]="";
           
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

    public function settab($tab){
        $this->tab = $tab;
    }
}
