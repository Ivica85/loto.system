<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OwnsCreditCard implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $userCreditCards = auth()->user()->cards()->first()->whereId($value)->first();

       if($userCreditCards === null){
           $fail('This card is not ours.');
       }
    }
}
