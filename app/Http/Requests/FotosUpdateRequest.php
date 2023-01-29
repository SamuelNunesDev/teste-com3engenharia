<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotosUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:arquivos,id',
            'nome' => 'required|max:255'
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
            'integer' => 'O campo :attribute deve ser do tipo numeral inteiro.',
            'max' => 'O campo :attribute deve ter no máximo 255 caracteres.',
            'exists' => 'O campo id deve corresponder a um arquivo dentro da tabela arquivos.'
        ];
    }
}
