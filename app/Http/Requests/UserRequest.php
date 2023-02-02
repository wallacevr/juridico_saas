<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name.required'=>'Campo Nome é Obrigatório!',
            'name.max'=>'O Tamanho máximo do campo nome é de 255 caracteres!',
            'email.required' => 'O Campo Email é obrigatório!',
            'email.email' => 'Email inválido!',
            'email.max' => 'O Tamanho máximo do campo email é de 255 caracteres!',
            'email.unique' => 'Email já cadastrado!',
            'password.required'=>'Campo senha é Obrigatório!',
            'password.string'=>'Preencha senha somente com letras e numeros!',
            'password.min'=>'Senha deve ter no mínimo 8 caracteres!',
            'password.confirmed'=>'Senha e confirmação de senha devem ser iguais!',
        ];
    }

    public function rules()
    {
       
        switch($this->method()){
            case 'POST':
                return [
                    'name'  => 'required|string|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' =>'required|min:8|string|Confirmed'
                ];
                break;
            case 'PUT':

                return [
                    'name'  => 'required|string|max:255',
                    'email' => "required|email|unique:users,email,".$this->user->id
                ];
                break;
        }


    }
}
