<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BEVatNumber implements Rule
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
        //check if vat number is correcte 
        if(count(str_split($value))>=12)
        {
            $value = str_replace('.','',$value);
            $array_value = str_split($value);
            $country_code = $array_value[0].$array_value[1];
            //dd($array_value);

            if($country_code==="BE")
            {
                //$vat_number = str_split($vat_number);
                //dd($vat_number);
                $vat_number_check_digit = null;
                $vat_number_without_check_digit = null;

                if(count($array_value) === 12)
                {
                    //get check digit (check digit is last to number in vat number)
                    $vat_number_check_digit = $array_value[10].$array_value[11];
                    $vat_number_without_check_digit = null;

                    //get vat number without .. and check digit
                    for ($i=2; $i <=9 ; $i++)
                    { 
                        if(in_array($array_value[$i],[0,1,2,3,4,5,6,7,8,9]))
                        {

                            if($vat_number_without_check_digit)
                            {
                                $vat_number_without_check_digit = $vat_number_without_check_digit.$array_value[$i];
                            }else{
                                $vat_number_without_check_digit = $array_value[$i];
                            }

                        }else{
                            return false;
                        }
                    }


                }
                
                //transform val to int
                $vat_number_check_digit = intval($vat_number_check_digit);
                //dd($vat_number_check_digit);
                $vat_number_without_check_digit = intval($vat_number_without_check_digit);
                
                $first_result = $vat_number_without_check_digit/97;
                $first_result = (int)$first_result;
                $second_result = $first_result*97;
                $third_result = $vat_number_without_check_digit-$second_result;
                $five_result = 97-$third_result;

                //dd($five_result);

                if($five_result===$vat_number_check_digit)
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
        return trans('validation.be_vat_number');
    }
}
