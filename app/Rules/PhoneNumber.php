<?php

namespace App\Rules;

use libphonenumber\PhoneNumberUtil;
use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public $country_code;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($country_code)
    {
        //
        $this->country_code = $country_code;
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
        if($this->country_code){
            $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();

            $phoneNumberObject = $phoneNumberUtil->parse($value, $this->country_code);
    
            if($phoneNumberUtil->isPossibleNumber($phoneNumberObject) && $phoneNumberUtil->isValidNumber($phoneNumberObject) && $phoneNumberUtil->isValidNumberForRegion($phoneNumberObject, $this->country_code))
                return true;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le numéro de téléphone est invalide.';
    }
}
