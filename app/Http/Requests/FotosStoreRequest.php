<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FotosStoreRequest extends FormRequest
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
            'arquivos' => 'array|required',
            'criado_por' => 'int|required'
        ];
    }

    public function messages()
    {
        return [
            'array' => 'O campo :attribute deve ser do tipo vetor de :attribute.',
            'required' => 'O campo :attribute é obrigatório',
            'int' => 'O campo :attribute deve ser do tipo numeral inteiro'
        ];
    }
}
