<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class HistoricoRequest extends FormRequest
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

                $rules['descricao']  = 'required|string';
                $rules['data']  = 'required|date';
              
                return $rules;
                break;
            case 'PUT':

 
               
                return $rules;
                break;
        }
    }
}
