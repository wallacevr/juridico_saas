<?php

namespace App\Http\Controllers\Tenant\Processos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes\Cliente;
use App\Models\Envolvidos\Envolvido;
use App\Models\Instancias\Instancia;
use App\Models\Varas\Varas;
use App\Models\Foros\Foro;
use App\Models\Acoes\Acao;
use App\Models\Historicos\Historicos;
use App\Models\Processos\Processo;
use App\Models\Qualificacoes\Qualificacoes;
use App\Models\Processos\ProcessoCliente;
use App\Models\Processos\ProcessoEnvolvido;
use App\Models\Processos\ProcessoUser;
use App\Http\Requests\ProcessoRequest;
use App\Http\Requests\HistoricoRequest;
use App\User;
use Auth;
class ProcessoController extends Controller
{
    //
    public function index(){
        $processos = Processo::with('clientes','instancia','vara','foro','acao')->get();
        
        return view('tenant.processos.index',compact('processos'));
    }
    public function create(){
        $clientes = Cliente::orderBy('nome')->get();
        $envolvidos = Envolvido::orderBy('nome')->get();
        $instancias = Instancia::orderBy('descricao')->get();
        $varas = Varas::orderBy('descricao')->get();
        $foros = Foro::orderBy('descricao')->get();
        $acoes = Acao::orderBy('descricao')->get();
        $qualificacoes = Qualificacoes::orderBy('descricao')->get();
        $users = User::orderBy('name')->get();
        return view('tenant.processos.create',compact('clientes','instancias','varas','foros','acoes','users','qualificacoes','envolvidos'));
    }

    public function store(ProcessoRequest $request){

        try {
            //code...
           
            $processo= new Processo;
            $processo->titulo = $request['titulo'];
            $processo->instancia_id = $request['instancia_id'];
         
            $processo->numero = $request['numero'];
            $processo->juizo = $request['juizo'];
            $processo->vara_id = $request['vara_id'];
            $processo->foro_id = $request['foro_id'];
            $processo->acao_id = $request['acao_id'] ;
            $processo->linktribunal = $request['linktribunal'];
            $processo->objeto = $request['objeto'] ;
            $processo->valorcausa = $request['valorcausa'] ;
            $processo->dtdistribuicao = $request['dtdistribuicao'];
            $processo->valorcondenacao = $request['valor condenacao'];
            $processo->observacoes= $request['observacoes'] ;
            $processo->porcentagemhonorarios = $request['porcentagemhonorarios'] ;
            $processo->honorarios = $request['honorarios'] ;
            $processo->save();
            foreach($request['cliente_id'] as $cliente_id){
                $processocliente = new ProcessoCliente;
                    $processocliente->processo_id= $processo->id;
                    $processocliente->cliente_id = $cliente_id;
                    $processocliente->qualificacao_id = $request['qualiclientes'];
                $processocliente->save();

            }
            foreach($request['envolvido_id'] as $envolvido_id){
                    $processoenvolvido = new ProcessoEnvolvido;
                    $processoenvolvido ->processo_id= $processo->id;
                    $processoenvolvido ->envolvido_id = $envolvido_id;
                    $processoenvolvido ->qualificacao_id = $request['qualienvolvidos'];
                $processoenvolvido->save();

            }
            foreach($request['responsavel_id'] as $responsavel_id){
                $processoresponsavel = new ProcessoUser;
                $processoresponsavel ->processo_id= $processo->id;
                $processoresponsavel->user_id = $responsavel_id;
        
                $processoresponsavel->save();

        }
            return redirect()->route('tenant.processos.index')->withSuccess('processo cadastrado com sucesso!');

        } catch (\Throwable $Error) {
            //throw $th;
            dd($Error);
            return redirect()->back()->withInput($request->all())->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }
    }

    public function show($id){
        try {
           
            $clientes = Cliente::orderBy('nome')->get();
            
            $envolvidos = Envolvido::orderBy('nome')->get();
            $instancias = Instancia::orderBy('descricao')->get();
            $varas = Varas::orderBy('descricao')->get();
            $foros = Foro::orderBy('descricao')->get();
            $acoes = Acao::orderBy('descricao')->get();
            
            $qualificacoes = Qualificacoes::orderBy('descricao')->get();
            $users = User::orderBy('name')->get();
         
            $processo = Processo::where('id','=',$id)
           
            ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
         
            return view('tenant.processos.show',compact('processo','clientes','instancias','varas','foros','acoes','users','qualificacoes','envolvidos'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function edit($id){
        $clientes = Cliente::orderBy('nome')->get();
        $envolvidos = Envolvido::orderBy('nome')->get();
        $instancias = Instancia::orderBy('descricao')->get();
        $varas = Varas::orderBy('descricao')->get();
        $foros = Foro::orderBy('descricao')->get();
        $acoes = Acao::orderBy('descricao')->get();
        $qualificacoes = Qualificacoes::orderBy('descricao')->get();
        $users = User::orderBy('name')->get();
        $processo = Processo::where('id','=',$id)
       
        ->with('clientes','instancia','vara','foro','acao','historico','recursos','desdobramentos')->get();
      
        return view('tenant.processos.edit',compact('processo','clientes','instancias','varas','foros','acoes','users','qualificacoes','envolvidos'));
    }
    public function addhistorico(HistoricoRequest $request,$processo){
      try {
        $id=$processo;
        $historico=new Historicos;
        $historico['data'] = $request['data'];
        $historico['descricao'] = $request['descricao'];
        $historico['empresa_id'] = Auth::user()->empresa_id;
        $historico['processo_id'] = $processo;
        $historico->save();
        $processo = Processo::where('id','=',$processo)
        
        ->with('clientes','instancia','vara','foro','acao','historico')->get();
        return redirect()->route('tenant.processo.edit',['id'=>$id])->withSuccess('Histórico cadastrado com sucesso!');
      
      } catch (\Throwable $th) {
        //throw $th;
        dd($th);
      }
    }

    public function createrecurso($id){
        $clientes = Cliente::orderBy('nome')->get();
        $envolvidos = Envolvido::orderBy('nome')->get();
        $instancias = Instancia::where('id','!=','1')->where('id','!=','5')->orderBy('descricao')->get();
        $varas = Varas::orderBy('descricao')->get();
        $foros = Foro::orderBy('descricao')->get();
        $acoes = Acao::orderBy('descricao')->get();
        $qualificacoes = Qualificacoes::orderBy('descricao')->get();
        $users = User::orderBy('name')->get();
        $processocliente = ProcessoCliente::where('processo_id','=',$id)->get();
        $processoenvolvidos = ProcessoEnvolvido::where('processo_id','=',$id)->get();
        $responsaveis = ProcessoUser::where('processo_id','=',$id)->get();
        $principal=Processo::find($id);
        return view('tenant.processos.createrecurso',compact('clientes','instancias','varas','foros','acoes','users','qualificacoes','envolvidos','processocliente','principal','processoenvolvidos','responsaveis'));
    }

    public function storerecurso(ProcessoRequest $request){

        try {
            //code...
           
            $processo= new Processo;
            $processo->titulo = $request['titulo'];
            $processo->instancia_id = $request['instancia_id'];
  
            $processo->numero = $request['numero'];
            $processo->juizo = $request['juizo'];
            $processo->vara_id = $request['vara_id'];
            $processo->foro_id = $request['foro_id'];
            $processo->acao_id = $request['acao_id'] ;
            $processo->linktribunal = $request['linktribunal'];
            $processo->objeto = $request['objeto'] ;
            $processo->valorcausa = $request['valorcausa'] ;
            $processo->dtdistribuicao = $request['dtdistribuicao'];
            $processo->valorcondenacao = $request['valor condenacao'];
            $processo->observacoes= $request['observacoes'] ;
            $processo->porcentagemhonorarios = $request['porcentagemhonorarios'] ;
            $processo->honorarios = $request['honorarios'] ;
            $processo->principal_recurso_id = $request['processo_id'] ;
            $processo->save();
            foreach($request['cliente_id'] as $cliente_id){
                $processocliente = new ProcessoCliente;
                    $processocliente->processo_id= $processo->id;
                    $processocliente->cliente_id = $cliente_id;
                    $processocliente->qualificacao_id = $request['qualiclientes'];
                $processocliente->save();

            }
            foreach($request['envolvido_id'] as $envolvido_id){
                    $processoenvolvido = new ProcessoEnvolvido;
                    $processoenvolvido ->processo_id= $processo->id;
                    $processoenvolvido ->envolvido_id = $envolvido_id;
                    $processoenvolvido ->qualificacao_id = $request['qualienvolvidos'];
                $processoenvolvido->save();

            }
            foreach($request['responsavel_id'] as $responsavel_id){
                $processoresponsavel = new ProcessoUser;
                $processoresponsavel ->processo_id= $processo->id;
                $processoresponsavel->user_id = $responsavel_id;
        
                $processoresponsavel->save();

        }
            return redirect()->route('tenant.processos.index')->withSuccess('processo cadastrado com sucesso!');

        } catch (\Throwable $Error) {
            //throw $th;
            dd($Error);
            return redirect()->back()->withInput($request->all())->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }
    }




    public function createdesdobramento($id){
        $clientes = Cliente::orderBy('nome')->get();
        $envolvidos = Envolvido::orderBy('nome')->get();
        $instancias = Instancia::where('id','!=','1')->where('id','!=','5')->orderBy('descricao')->get();
        $varas = Varas::orderBy('descricao')->get();
        $foros = Foro::orderBy('descricao')->get();
        $acoes = Acao::orderBy('descricao')->get();
        $qualificacoes = Qualificacoes::orderBy('descricao')->get();
        $users = User::orderBy('name')->get();
        $processocliente = ProcessoCliente::where('processo_id','=',$id)->get();
        $processoenvolvidos = ProcessoEnvolvido::where('processo_id','=',$id)->get();
        $responsaveis = ProcessoUser::where('processo_id','=',$id)->get();
        $principal=Processo::find($id);
        return view('tenant.processos.createdesdobramento',compact('clientes','instancias','varas','foros','acoes','users','qualificacoes','envolvidos','processocliente','principal','processoenvolvidos','responsaveis'));
    }

    public function storedesdobramento(ProcessoRequest $request){

        try {
            //code...
           
            $processo= new Processo;
            $processo->titulo = $request['titulo'];
            $processo->instancia_id = $request['instancia_id'];
   
            $processo->numero = $request['numero'];
            $processo->juizo = $request['juizo'];
            $processo->vara_id = $request['vara_id'];
            $processo->foro_id = $request['foro_id'];
            $processo->acao_id = $request['acao_id'] ;
            $processo->linktribunal = $request['linktribunal'];
            $processo->objeto = $request['objeto'] ;
            $processo->valorcausa = $request['valorcausa'] ;
            $processo->dtdistribuicao = $request['dtdistribuicao'];
            $processo->valorcondenacao = $request['valor condenacao'];
            $processo->observacoes= $request['observacoes'] ;
            $processo->porcentagemhonorarios = $request['porcentagemhonorarios'] ;
            $processo->honorarios = $request['honorarios'] ;
            $processo->principal_desdobramento_id = $request['processo_id'] ;
            $processo->save();
            foreach($request['cliente_id'] as $cliente_id){
                $processocliente = new ProcessoCliente;
                    $processocliente->processo_id= $processo->id;
                    $processocliente->cliente_id = $cliente_id;
                    $processocliente->qualificacao_id = $request['qualiclientes'];
                $processocliente->save();

            }
            foreach($request['envolvido_id'] as $envolvido_id){
                    $processoenvolvido = new ProcessoEnvolvido;
                    $processoenvolvido ->processo_id= $processo->id;
                    $processoenvolvido ->envolvido_id = $envolvido_id;
                    $processoenvolvido ->qualificacao_id = $request['qualienvolvidos'];
                $processoenvolvido->save();

            }
            foreach($request['responsavel_id'] as $responsavel_id){
                $processoresponsavel = new ProcessoUser;
                $processoresponsavel ->processo_id= $processo->id;
                $processoresponsavel->user_id = $responsavel_id;
        
                $processoresponsavel->save();

        }
            return redirect()->route('tenant.processos.index')->withSuccess('Processo cadastrado com sucesso!');

        } catch (\Throwable $Error) {
            //throw $th;
            dd($Error);
            return redirect()->back()->withInput($request->all())->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }
    }


    public function update(ProcessoRequest $request,$processo){

        try {
            //code...
           
            $processo= Processo::find($processo);
            $processo->titulo = $request['titulo'];
            $processo->instancia_id = $request['instancia_id'];
       
            $processo->numero = $request['nprocesso'];
            $processo->juizo = $request['juizo'];
            $processo->vara_id = $request['vara_id'];
            $processo->foro_id = $request['foro_id'];
            $processo->acao_id = $request['acao_id'] ;
            $processo->linktribunal = $request['linktribunal'];
            $processo->objeto = $request['objeto'] ;
            $processo->valorcausa = $request['valorcausa'] ;
            $processo->dtdistribuicao = $request['dtdistribuicao'];
            $processo->valorcondenacao = $request['valorcondenacao'];
            $processo->observacoes= $request['observacoes'] ;
            $processo->porcentagemhonorarios = $request['porcentagemhonorarios'] ;
            $processo->honorarios = $request['honorarios'] ;
            $processo->update();
            $deleted = \DB::table('cliente_processo')->where('processo_id', '=', $processo->id)->delete();
            foreach($request['cliente_id'] as $cliente_id){
                $processocliente = new ProcessoCliente;
                    $processocliente->processo_id= $processo->id;
                    $processocliente->cliente_id = $cliente_id;
                    $processocliente->qualificacao_id = $request['qualiclientes'];
                $processocliente->save();

            }
            $deleted = \DB::table('envolvido_processo')->where('processo_id', '=', $processo->id)->delete();
            foreach($request['envolvido_id'] as $envolvido_id){
                    $processoenvolvido = new ProcessoEnvolvido;
                    $processoenvolvido ->processo_id= $processo->id;
                    $processoenvolvido ->envolvido_id = $envolvido_id;
                    $processoenvolvido ->qualificacao_id = $request['qualienvolvidos'];
                $processoenvolvido->save();

            }
            $deleted = \DB::table('processo_user')->where('processo_id', '=', $processo->id)->delete();
            foreach($request['responsavel_id'] as $responsavel_id){
                $processoresponsavel = new ProcessoUser;
                $processoresponsavel ->processo_id= $processo->id;
                $processoresponsavel->user_id = $responsavel_id;
        
                $processoresponsavel->save();

         } 

            return redirect()->route('tenant.processos.index')->withSuccess('Processo alterado com sucesso!');

        } catch (\Throwable $Error) {
            //throw $th;
            dd($Error);
            return redirect()->back()->withInput($request->all())->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }
    }
    public function destroy(Processo $processo){

        try {
          $processo->delete();
          return redirect()->route('tenant.processos.index')->withSuccess('Processo Deletado com sucesso!');
        } 
        catch(\Throwable $Error)
        {
        
            return redirect()->back()->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }  
       }


}
