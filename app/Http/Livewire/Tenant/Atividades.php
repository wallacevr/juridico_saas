<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;
use App\Models\Processos\Processo;
use Auth;
use App\Models\Tarefas\Tarefa;
class Atividades extends Component
{
    public $showadd= false;
    public $data;
    public $prazolimite;
    public $descricao;

    public function showadd()
    {
        $this->showadd = true;
    }

    public function hideadd()
    {
        $this->data=null;
        $this->prazolimite=null;
        $this->descricao="";
        $this->showadd = false;
    }

    public function store()
    {
        try{
                 // Implemente a lógica de armazenamento de dados aqui
                $tarefa= new Tarefa;
                $tarefa->data = $this->data;
                $tarefa->prazolimite = $this->prazolimite;
                $tarefa->descricao = $this->descricao;
                $tarefa->processo_id = $this->processo[0]->id;
                $tarefa->save();
                $this->showadd = false;
                $this->hideadd();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }


    public function mount($id){
       
        $this->processo = Processo::where('id','=',$id)
   
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
        
    }
    public function render()
    {
        return view('livewire.tenant.atividades');
    }
    public function limpartarefa(){
        $this->data= null;
        $this->prazo=null;
        $this->descricao="";
    }
    public function addtarefa(){
        try{
            $tarefa = new Tarefa();
            $tarefa->data = $this->data;
            $tarefa->prazolimite = $this->prazo;
            $tarefa->descricao= $this->descricao;

            $tarefa->processo_id=$this->processo[0]->id;
          
            $tarefa->save();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
