<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;
use Auth;
use App\Models\Envolvidos\Envolvido;
class EnvolvidosIndex extends Component
{
    public $envolvidos;
    public $show;
    public $envolvido_id;
    public function render()
    {
        return view('livewire.tenant.envolvidos.envolvidos-index');
    }
    public function mount(){
        $this->envolvidos = Envolvido::All();
    }

    public function modaledtenvolvido($id){
        $envolvido = Envolvido::find($id);
      
        $this->nome = $envolvido->nome;
        $this->envolvido_id =  $id;
        $this->show = true;
    }
    public function escondermodal(){
        
        
        $this->nome ="";
       
        $this->show = false;
    }

    public function update(){
        $envolvido = Envolvido::find($this->envolvido_id);

        $envolvido->nome = $this->nome;
        $envolvido->update();
        $this->data = "";
        $this->descricao ="";
        $this->envolvidos = Envolvido::All();
        $this->show = false;
    }
    public function delete($id){
        $envolvido = Envolvido::find($id);
        $envolvido->ativado=0;
        $envolvido->update();
        $this->envolvidos = Envolvido::all();
 
    }
}
