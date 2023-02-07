<?php

namespace App\Http\Livewire\Tenant;

use Livewire\Component;
use App\Models\Processos\Processo;
use Auth;
class Atividades extends Component
{
    public  $processo;
    public $data;
    public $descricao;
    public $show;
    public $historico_id;
    public $description;
    public function mount($id){
       
        $this->processo = Processo::where('id','=',$id)
   
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
        
    }
    public function render()
    {
        return view('livewire.tenant.atividades');
    }
}
