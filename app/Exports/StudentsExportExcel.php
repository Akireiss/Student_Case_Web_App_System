<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExportExcel implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Students::with('classroom')->get(['first_name', 'middle_name', 'last_name', 'gender', 'department', 'lrn', 'classroom_id']);
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Gender',
            'Department',
            'LRN',
            'Classroom ID',
            'Section',        // Include Section in headings
            'Grade Level',    // Include Grade Level in headings
        ];
    }
}
