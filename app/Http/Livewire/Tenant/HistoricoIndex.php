<?php

namespace App\Http\Livewire\Tenant;
use Auth;
use Livewire\Component;
use App\Models\Processos\Processo;
use App\Models\Historicos\Historicos;
class HistoricoIndex extends Component
{
    public  $processo;
    public $data;
    public $descricao;
    public $show;
    public $historico_id;
    public function mount($id){
        $this->processo = Processo::where('id','=',$id)
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
    }
    public function render()
    {
        return view('livewire.tenant.historico-index');
    }

    public function modaledthistorico($id){
        $historico = Historicos::find($id);
        $this->data = $historico->data;
        $this->descricao = $historico->descricao;
        $this->historico_id =  $id;
        $this->show = true;
    }
   
    public function escondermodal(){
        
        $this->data = "";
        $this->descricao ="";
       
        $this->show = false;
    }

    public function update(){
        $historico = Historicos::find($this->historico_id);
        $historico->data =  $this->data;
        $historico->descricao = $this->descricao;
        $historico->update();
        $this->data = "";
        $this->descricao ="";
        $this->processo = Processo::where('id','=',$historico->processo_id)
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
        $this->show = false;
    }
    public function delete($id){
        $historico = Historicos::find($id);
        $historico->delete();
        $this->processo = Processo::where('id','=',$historico->processo_id)
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
 
    }


}
