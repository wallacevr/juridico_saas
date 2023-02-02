<?php

namespace App\Http\Controllers\Tenant\Envolvido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Envolvidos\Envolvido;
use Auth;
class EnvolvidoController extends Controller
{
    //
    public function index(){
       
        return view('tenant.envolvidos.index');
    }

    public function store(Request $request){
      
        try {
            //code...
            $envolvido= new Envolvido;
            $envolvido->nome = $request->nome;
      
            
           
            $envolvido->save();
            return redirect()->route('tenant.envolvidos.index')->withSuccess('Envolvido cadastrado com sucesso!');

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

    public function destroy(Envolvido $envolvido){
       
     
        $envolvido->delete();
        $this->envolvidos = Envolvido::all();
        return redirect()->route('tenant.envolvidos.index')->withSuccess('Envolvido cadastrado com sucesso!');
 
    }



}
