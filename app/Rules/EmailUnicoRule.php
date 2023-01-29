<?php

namespace App\Rules;

use App\Models\Usuario;
use Illuminate\Contracts\Validation\Rule;

class EmailUnicoRule implements Rule
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
        return !Usuario::whereEmail($value)->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Já existe um usuário ativo com este email cadastrado.';
    }
}
