<?php

namespace App\Http\Requests;

use App\Rules\User\EmailNotTaken;
use Illuminate\Foundation\Http\FormRequest;

class UserAccountSaveRequest extends FormRequest
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
            'email'    => [
                "required","string","email",
                new EmailNotTaken(),
            ],
            'name'     => "required|string|min:3",
            'password' => "nullable|required|string|min:5"
        ];
    }
}
