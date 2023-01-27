<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAutenticarRequest extends FormRequest
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
            'email' => 'required|email|exists:usuarios,email',
            'senha' => 'required|min:8'
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
            'exists' => 'Não existe nenhum usuário cadastrado com o email informado.'
        ];
    }
}
