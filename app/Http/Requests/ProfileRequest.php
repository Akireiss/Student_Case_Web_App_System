<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'student_id'=> [
                'required'
            ],
            'm_name'=> [
                'required'
            ],
            'suffix'=> [
                'required'
            ],
            'nickname'=> [
                'required',
            ],
            'age'=> [
                'required',
                'integer'
            ],
            'sex'=> [
                'required',
                'string'
            ],
            ''=> [
                'required'
            ],
            'birthdate'=> [
                'required'
            ],
            'contact'=> [
                'required'
            ],
            'mother_tongue'=> [
                'required'
            ],
            '4ps'=> [
                'required'
            ],
            'living_with'=> [
                'required'
            ],
            'guardian_name'=> [
                'required'
            ],
            'relationship'=> [
                'required'
            ],
            'guardian_age'=> [
                'required'
            ],
        ];
    }
}
