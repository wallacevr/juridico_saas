<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); // <------------------
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method()){
            case 'POST':

                if($this->tppessoa==1)
                {
                    $rules['cpf']  = 'required|string|size:14|unique:clientes';
                  
                }else{
                    $rules['cnpj']  = 'required|string|size:18|unique:clientes';
                    $rules['ie'] ='nullable|string';
                    $rules['simples'] ='nullable';
                }
                $rules['nome']= 'required|string|max:255';
                $rules['nomefantasia']  = 'nullable|string|max:255';
                $rules['email'] ='nullable|email|max:255';
                $rules['telefone'] ='nullable|size:15|string';
                $rules['site'] = 'nullable|url|max:255';
                $rules['cep'] ='nullable|size:9|string';
                $rules['uf'] ='nullable|size:2|string';
                $rules['cidade'] ='nullable|max:255|string';
                $rules['bairro'] ='nullable|max:255|string';
                $rules['rua'] ='nullable|max:255|string';
                $rules['numero'] ='nullable|max:255|string';
                $rules['complemento'] ='nullable|max:255|string';
              
              

                $rules['rg'] ='nullable|string';
                $rules['ctps'] ='nullable|max:255|string';
                $rules[ 'pis'] ='nullable|max:255|string';
                $rules['cnh'] ='nullable|max:255|string';
                $rules['titulo'] ='nullable|max:255|string';
                $rules['passaporte'] ='nullable|max:255|string';
                $rules['reservista'] ='nullable|max:255|string';
                $rules['nomemae'] ='nullable|max:255|string';
                $rules['nomepai'] ='nullable|max:255|string';
                $rules['naturalidade'] ='nullable|max:255|string';
                $rules['nacionalidade'] ='nullable|max:255|string';
                $rules['dtnasc'] ='nullable|date';
                if($this->tpconta_id!="")
                {
                    $rules['banco'] = 'required';
                    $rules['agencia'] = 'required';
                    $rules['conta'] = 'required';  
                  
                }
                
                break;
            case 'PUT':
                $id=str_replace('/admin/cliente/alterar/','',$this->getRequestUri());
              
            
                if($this->tppessoa==1)
                {
                    $rules['cpf']  = 'required|string|size:14|unique:clientes,id,'. $id ;
                  
                }else{
                    $rules['cnpj']  = 'required|string|size:18|unique:clientes,id,'. $id ;
                }
                $rules['nome']= 'required|string|max:255';
                $rules['nomefantasia']  = 'nullable|string|max:255';
                $rules['email'] ='nullable|email|max:255';
                $rules['telefone'] ='nullable|size:15|string';
                $rules['site'] = 'nullable|url|max:255';
                $rules['cep'] ='nullable|size:9|string';
                $rules['uf'] ='nullable|size:2|string';
                $rules['cidade'] ='nullable|max:255|string';
                $rules['bairro'] ='nullable|max:255|string';
                $rules['rua'] ='nullable|max:255|string';
                $rules['numero'] ='nullable|max:255|string';
                $rules['complemento'] ='nullable|max:255|string';
              
              
                $rules['ie'] ='nullable|string';
                $rules['simples'] ='nullable';
                $rules['rg'] ='nullable|string';
                $rules['ctps'] ='nullable|max:255|string';
                $rules[ 'pis'] ='nullable|max:255|string';
                $rules['cnh'] ='nullable|max:255|string';
                $rules['titulo'] ='nullable|max:255|string';
                $rules['passaporte'] ='nullable|max:255|string';
                $rules['reservista'] ='nullable|max:255|string';
                $rules['nomemae'] ='nullable|max:255|string';
                $rules['nomepai'] ='nullable|max:255|string';
                $rules['naturalidade'] ='nullable|max:255|string';
                $rules['nacionalidade'] ='nullable|max:255|string';
                $rules['dtnasc'] ='nullable|date';
                if($this->tpconta_id!="")
                {
                    $rules['banco'] = 'required';
                    $rules['agencia'] = 'required';
                    $rules['conta'] = 'required';  
                  
                }
               
             
                break;
        }

        return $rules;
    }
}
