<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalRegistry implements Rule
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
        //
        if(preg_match('/\d{2}[.]\d{2}[.]\d{2}[-]\d{3}[.]\d{2}$/',$value)===1)
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le format du champ national registry est invalide. Le format correcte est : 99.99.99-999.99';
    }
}
