<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'diary_a1' => ['required', 'string', 'max:100',],
            'diary_a2' => ['required', 'string', 'max:100',],
            'diary_a3' => ['required', 'string', 'max:100',],
            'diary_a4' => ['required', 'string', 'max:100',],
        ];
    }
}
