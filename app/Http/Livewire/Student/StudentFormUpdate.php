<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class StudentFormUpdate extends Component
{

    public $studentId;
    public function mount($id)
    {
        $this->studentId = $id;
    }
    public function render()
    {
        return view('livewire.student.student-form-update')
        ->extends('layouts.app')
        ->section('content');
    }
}
