<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnecdotalRequest extends FormRequest
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
        'student_id' => [
            'required'
        ],
        'grave_offense_id' => [
            'nullable'
        ],
        'minor_offense_id' => [
            'nullable'
        ],
        'gravity' => [
            'string',
            'required'
        ],
        'short_description' => [
            'string',
            'nullable'
        ],
        'observation' => [
            'string',
        ],
        'desired' => [
            'string',
        ],
        'outcome' => [
            'string',
        ],
        'letter' => [
            'nullable',
            'image'
        ],
        'status' => [
            'required',
            'integer'
        ],

        ];
    }
}
