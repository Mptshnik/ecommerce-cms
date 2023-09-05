<?php

namespace App\Rules\Api;

use App\Models\Customer;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

class EncryptedPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $customers = Customer::all();

        foreach ($customers as $customer){
            if($value == $customer->phone_number){
                $fail('Этот номер телефона уже используется');
            }
        }
    }
}
