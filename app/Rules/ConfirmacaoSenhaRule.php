<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ConfirmacaoSenhaRule implements Rule
{
    private $senha;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($senha)
    {
        $this->senha = $senha;
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
        return $this->senha === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'As senhas não conferem.';
    }
}
