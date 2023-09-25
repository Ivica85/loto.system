<?php

namespace App\Rules\User;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class EmailNotTaken implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where(['email'=>$value])->first();
        if($user instanceof User){
            if($user->id != Auth::user()->id){
                $fail('This email is already taken');
            }
        }
    }
}
