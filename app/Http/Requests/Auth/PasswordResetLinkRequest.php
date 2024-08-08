<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class PasswordResetLinkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw ValidationException::withMessages($validator->errors()->toArray());
    }

    public function failedSendPasswordResetLink($status)
    {
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
