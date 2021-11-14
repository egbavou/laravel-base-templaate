<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OrderHasEventProductRule implements Rule
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
        $find = false;
        foreach ($value as $order_has_event_product)
        {
            if($order_has_event_product['quantity']>0)
                $find = true;
        }

        if($find)
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La commande ne peut pas avoir un total à payer TVAC d\'une valeur de 0 €.';
    }
}
