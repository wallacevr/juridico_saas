<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'razaosocial.required'=>'Campo Razão Social é Obrigatório!',
            'razaosocial.max'=>'O Tamanho máximo do campo Razão Social é de 255 caracteres!',
            'razaosocial.string' => 'Preecha o campo Razão Social com Letras e/ou Números!',
            'cnpj.required'=>'Campo CNPJ é Obrigatório!',
            'cnpj.unique' =>'CNPJ já cadastrado!',
            'cnpj.size'=>'O Tamanho do campo CNPJ é inválido!',
            'celular.required' => 'O campo celular é obrigatório!',
            'email.required' => 'O Campo Email é obrigatório!',
            'email.email' => 'Email inválido!',
            'email.max' => 'O Tamanho máximo do campo email é de 255 caracteres!',
            'email.unique' => 'Email já cadastrado!',
            
            'password.required'=>'Campo senha é Obrigatório!',
            'password.string'=>'Preencha senha somente com letras e numeros!',
            'password.min'=>'Senha deve ter no mínimo 8 caracteres!',
            'password.confirmed'=>'Senha e confirmação de senha devem ser iguais!',
            'nome.required'=>'Campo Nome do Admin é Obrigatório!',
            'nome.max'=>'O Tamanho máximo do campo Nome do Admin é de 255 caracteres!',
            'nome.string' => 'Preecha o campo Nome do Admin com Letras e/ou Números!',
        ];
    }


    public function rules()
    {
        switch($this->method()){
            case 'POST':
                return [
                    'razaosocial'  => 'required|string|max:255',
                    'cnpj'  => 'required|string|size:18|unique:empresa',
                    'email' => 'required|email|max:255|unique:empresa',
                    'celular' =>'required|size:15|string',

                    'password'=>'required|min:8|string',
                    'nome'  => 'required|string|max:255',
                ];
                break;
            case 'PUT':

                return [
                    'razaosocial'  => 'required|string|max:255',
                    'email' => "required|email|unique:users,email,".$this->user->id
                ];
                break;
        }
    }
}
