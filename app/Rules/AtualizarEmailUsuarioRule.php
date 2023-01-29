<?php

namespace App\Rules;

use App\Models\Usuario;
use Illuminate\Contracts\Validation\Rule;

class AtualizarEmailUsuarioRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $email_existente = Usuario::whereEmail($value)->first();
        
        return !$email_existente || ($email_existente->id === auth()->user()->id);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Já existe um usuário com este email cadastrado.';
    }
}
