<?php

namespace App\Http\Requests;

use App\Rules\OwnsCreditCard;
use Illuminate\Foundation\Http\FormRequest;

class AddCreditsRequest extends FormRequest
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
            "credits" => 'required',
            "credit_card" => [
                'required',
                new OwnsCreditCard(),
            ]
        ];
    }
}
