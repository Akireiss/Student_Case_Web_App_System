<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\Students;
use App\Traits\SelectNameTrait;

class StudentForm extends Component
{
    use SelectNameTrait;
    public function render()
    {
        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        return view('livewire.student.student-form', [
            'students' => $students,
        ])->extends('layouts.app')
            ->section('content');
    }

}
