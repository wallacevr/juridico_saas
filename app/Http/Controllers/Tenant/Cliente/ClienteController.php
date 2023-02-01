<?php

namespace App\Http\Controllers\Tenant\Cliente;
use App\Models\Clientes\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use Auth;
class ClienteController extends Controller
{
    //
    public function index(){
        $clientes = Cliente::All();
        return view('tenant.clientes.index',compact('clientes'));
    }
    public function create(){

        return view('tenant.clientes.create');
    }

    public function store(ClienteRequest $request){

        try {
            //code...
            $cliente= new Cliente;
            $cliente->nome = $request->nome;
            $cliente->nomefantasia = $request->nomefantasia;
            $cliente->empresa_id = Auth::user()->empresa_id;
            $cliente->cpf = $request['cpf'];
            $cliente->cnpj = $request['cnpj'];
            $cliente->email = $request['email'];
            $cliente->telefone = $request['telefone'];
            $cliente->site = $request['site'] ;
            $cliente->cep = $request['cep'];
            $cliente->uf = $request['uf'] ;
            $cliente->municipio = $request['cidade'] ;
            $cliente->bairro = $request['bairro'];
            $cliente->logradouro = $request['rua'];
            $cliente->num = $request['numero'] ;
            $cliente->complemento = $request['complemento'] ;
          
          
            $cliente->ie = $request['ie'];
            $cliente->simples = $request['simples'] ;
            $cliente->rg = $request['rg'] ;
            $cliente->ctps =  $request['ctps'] ;
            $cliente->pis = $request[ 'pis'] ;
            $cliente->cnh  = $request['cnh'] ;
            $cliente->tituloeleitor = $request['titulo'] ;
            $cliente->passaporte = $request['passaporte'] ;
            $cliente->certificadoreservista = $request['reservista'] ;
            $cliente->nomemae = $request['nomemae'];
            $cliente->nomepai = $request['nomepai'] ;
            $cliente->naturalidade = $request['naturalidade'];
            $cliente->nacionalidade = $request['nacionalidade'] ;
            $cliente->dtnascimento = $request['dtnasc'] ;
          
            $cliente->banco = $request['banco'] ;
            $cliente->agencia =    $request['agencia'];
            $cliente->conta =   $request['conta'] ;  
              
            
           
            $cliente->save();
            return redirect()->route('tenant.clientes.index')->withSuccess('Cliente cadastrado com sucesso!');

        } catch (\Throwable $Error) {
            //throw $th;
           
            return redirect()->back()->withInput($request->all())->withErrors([
                'message' => [
                    $Error->getMessage()
                ],
            ]);
        }
    }

    public function show(Cliente $cliente){

        try {
           if($cliente->empresa_id==Auth::user()->empresa_id){
               return view('tenant.clientes.show',compact('cliente'));
             }else{
               throw new \Exception("Cliente não encontrado");
             }
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
    public function edit(Cliente $cliente){

     try {
        if($cliente->empresa_id==Auth::user()->empresa_id){
            return view('tenant.clientes.edit',compact('cliente'));
          }else{
            throw new \Exception("Cliente não encontrado");
          }
     } 
     catch(\Throwable $Error)
     {
         return redirect()->back()->withInput($request->all())->withErrors([
             'message' => [
                 $Error->getMessage()
             ],
         ]);
     }  
    }



    public function update(ClienteRequest $request, Cliente $cliente){

        try {
            //code...
           
            $cliente->nome = $request->nome;
            $cliente->nomefantasia = $request->nomefantasia;
            $cliente->empresa_id = Auth::user()->empresa_id;
            $cliente->cpf = $request['cpf'];
            $cliente->cnpj = $request['cnpj'];
            $cliente->email = $request['email'];
            $cliente->telefone = $request['telefone'];
            $cliente->site = $request['site'] ;
            $cliente->cep = $request['cep'];
            $cliente->uf = $request['uf'] ;
            $cliente->municipio = $request['cidade'] ;
            $cliente->bairro = $request['bairro'];
            $cliente->logradouro = $request['rua'];
            $cliente->num = $request['numero'] ;
            $cliente->complemento = $request['complemento'] ;
          
          
            $cliente->ie = $request['ie'];
            $cliente->simples = $request['simples'] ;
            $cliente->rg = $request['rg'] ;
            $cliente->ctps =  $request['ctps'] ;
            $cliente->pis = $request[ 'pis'] ;
            $cliente->cnh  = $request['cnh'] ;
            $cliente->tituloeleitor = $request['titulo'] ;
            $cliente->passaporte = $request['passaporte'] ;
            $cliente->certificadoreservista = $request['reservista'] ;
            $cliente->nomemae = $request['nomemae'];
            $cliente->nomepai = $request['nomepai'] ;
            $cliente->naturalidade = $request['naturalidade'];
            $cliente->nacionalidade = $request['nacionalidade'] ;
            $cliente->dtnascimento = $request['dtnasc'] ;
          
            $cliente->banco = $request['banco'] ;
            $cliente->agencia =    $request['agencia'];
            $cliente->conta =   $request['conta'] ;  
              
            
           
            $cliente->save();
            return redirect()->route('tenant.clientes.index')->withSuccess('Cliente Alterado com sucesso!');

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

    public function destroy(Cliente $cliente){

        try {
          $cliente->delete();
          return redirect()->route('tenant.clientes.index')->withSuccess('Cliente Deletado com sucesso!');
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
