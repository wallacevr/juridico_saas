<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ProcessoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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

                $rules['cliente_id']  = 'required|array|min:1';
                $rules['qualiclientes']  = 'required';
                $rules['envolvido_id']  = 'array|min:0';
                $rules['qualienvolvidos']  = 'required';
                $rules['titulo']= 'required|string|max:255';
                $rules['instancia']  = 'nullable';
                $rules['nprocesso']= 'nullable|string|max:255';
                $rules['juizo']= 'nullable|string|max:255';
                $rules['vara_id']= 'nullable|string|max:255';
                $rules['foro_id']= 'nullable|string|max:255';
                $rules['acao_id']= 'nullable|string|max:255';
                $rules['linktribunal']= 'nullable|string|max:255';
                $rules['objeto']= 'nullable|string';
                $rules['valorcausa']= 'nullable|numeric';
                $rules['dtdistribuicao']= 'nullable|date';
                $rules['valorcondencacao']= 'nullable|numeric';
                $rules['observacoes']= 'nullable|string';
                $rules['responsavel_id']  = 'required|array|min:1';
                $rules['porcentagemhoorarios']= 'nullable|numeric';
                $rules['honorarios']= 'nullable|numeric';
                return $rules;
                break;
            case 'PUT':

                $rules['cliente_id']  = 'required|array|min:1';
                $rules['qualiclientes']  = 'required';
                $rules['envolvido_id']  = 'array|min:0';
                $rules['qualienvolvidos']  = 'required';
                $rules['titulo']= 'required|string|max:255';
                $rules['instancia']  = 'nullable';
                $rules['nprocesso']= 'nullable|string|max:255';
                $rules['juizo']= 'nullable|string|max:255';
                $rules['vara_id']= 'nullable|string|max:255';
                $rules['foro_id']= 'nullable|string|max:255';
                $rules['acao_id']= 'nullable|string|max:255';
                $rules['linktribunal']= 'nullable|string|max:255';
                $rules['objeto']= 'nullable|string';
                $rules['valorcausa']= 'nullable|numeric';
                $rules['dtdistribuicao']= 'nullable|date';
                $rules['valorcondencacao']= 'nullable|numeric';
                $rules['observacoes']= 'nullable|string';
                $rules['responsavel_id']  = 'required|array|min:1';
                $rules['porcentagemhoorarios']= 'nullable|numeric';
                $rules['honorarios']= 'nullable|numeric';
               
                return $rules;
                break;
        }
    }
}
