<?php

namespace App\Imports;

use App\Models\Students;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return Students|null
    */
    public function model(array $row)
    {
        return new Students([
            'first_name'   => $row['first_name'],
            'middle_name'    => $row['middle_name'],
            'last_name'    => $row['last_name'],
            'gender'       => $row['gender'],
            'classroom_id' => null,
            'department'   => $row['department'],
            'lrn'          => $row['lrn'],
            'status'          => 0,
        ]);
    }

    /**
     * @param array $row
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name'   => 'required',
            'last_name'    => 'required',
            'gender'       => 'required',
            'classroom_id' => 'required',
            'department'   => 'required',
            'lrn'          => 'required',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'first_name.required'   => 'First name is required.',
            'last_name.required'    => 'Last name is required.',
            'gender.required'       => 'Gender is required.',
            'classroom_id.required' => 'Classroom ID is required.',
            'department.required'   => 'Department is required.',
            'lrn.required'          => 'LRN is required.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return void
     */
    public function onFailure(ValidationException $e)
    {
        // Log the validation failure
        \Log::error('Validation failure during import: ' . $e->getMessage());
    }
}
