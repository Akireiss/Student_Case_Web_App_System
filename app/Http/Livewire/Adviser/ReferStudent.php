<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Classroom;
use App\Models\Students;
use App\Traits\StudentTrait;
use Livewire\Component;

class ReferStudent extends Component
{
    use StudentTrait;
    public $student;

    public function mount($student)
    {
        $this->student = $student;
        $student = Students::findOrFail($student);
        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->last_name;
        $this->lrn = $student->lrn;
        $this->classroom_id = $student->classroom_id;


    }

    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.adviser.refer-student', [
            'student' => $this->student,
            'classrooms' => $classrooms
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
}
