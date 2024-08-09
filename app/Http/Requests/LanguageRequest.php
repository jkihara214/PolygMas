<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'jp_name' => ['required', 'string', 'max:255', 'unique:' . Language::class],
            'en_name' => ['required', 'string', 'max:255', 'unique:' . Language::class],
            'code' => ['required', 'string', 'max:255', 'unique:' . Language::class],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3072'],
        ];
    }
}
