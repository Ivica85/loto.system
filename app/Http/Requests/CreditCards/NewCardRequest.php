<?php

namespace App\Http\Requests\CreditCards;

use Illuminate\Foundation\Http\FormRequest;

class NewCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
           'card_number' => 'required|int|digits_between:12,16|unique:credit_cards,card_number',
            'cvv'        => 'required|int|digits_between:3,4',
            'expiry_year' => 'required',
            'expiry_month' => 'required'
        ];
    }
}
