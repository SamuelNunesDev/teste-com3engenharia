<?php

namespace App\Http\Requests;

use App\Rules\AtualizarEmailUsuarioRule;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
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
            'email' => ['email', new AtualizarEmailUsuarioRule()],
            'nome' => 'max:255',
            'senha_atual' => 'string|min:8',
            'nova_senha' => 'string|min:8',
            'senha_confirmar' => 'string|min:8'
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
            'email' => 'O campo :attribute deve ser do tipo email.',
            'min' => 'O campo :attribute deve ter no mínimo 8 caracteres.',
            'max' => 'O campo :attribute deve ter no máximo 255 caracteres.',
            'unique' => 'Já existe um usuário cadastrado com o email informado.',
            'string' => 'O campo :attribute deve ser do tipo texto.'
        ];
    }
}
