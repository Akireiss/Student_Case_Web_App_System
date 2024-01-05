<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Students::all(['first_name', 'middle_name', 'last_name', 'gender', 'classroom_id', 'department', 'lrn']);
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Middle Name',
            'Last Name',
            'Gender',
            'Classroom',
            'Department',
            'LRN',
        ];
    }
}
