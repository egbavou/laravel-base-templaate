<?php

namespace App\Rules;

use App\Models\Companies\Company;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmail implements Rule
{
    public $name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
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
        if(Company::where('name',$this->name)->first()){
            return true;
        }else{
            if(!Company::where('email',$value)->first()){
                return true;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La valeur du champ email est déjà utilisée.';
    }
}
