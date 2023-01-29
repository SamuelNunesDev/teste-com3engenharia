<?php

namespace App\Http\Requests;

use App\Rules\ConfirmacaoSenhaRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginSalvarUsuarioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'string|required',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:8',
            'confirmacao_senha' => new ConfirmacaoSenhaRule($this->request->get('password'))
        ];
    }

    /**
     * Define as mensagens em caso de erro.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O campo :attribute deve ser do tipo email.',
            'min' => 'O campo :attribute deve ter no mínimo 8 caracteres.',
            'unique' => 'Já existe um usuário cadastrado com o email informado.',
            'string' => 'O campo :attribute deve ser do tipo texto.'
        ];
    }
}
