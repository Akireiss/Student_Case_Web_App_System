<?php

namespace App\Http\Livewire\Admin;

use App\Traits\StudentTrait;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\Students;

class Student extends Component
{
    use StudentTrait;
    public $successMessage = '';
    public $isSubmitting = false;


    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.admin.student', compact('classrooms'))
            ->extends('layouts.dashboard.index')
            ->section('content');

    }

    public function store()
    {
        $this->validate();

        $this->isSubmitting = true;

        Students::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'lrn' => $this->lrn,
            'classroom_id' => $this->classroom_id,
            'gender' => $this->gender,
            'status' => $this->status,
        ]);

        $this->resetForm();
        session()->flash('message', 'Student Successfully Added');
        $this->isSubmitting = false;
    }


    private function resetForm()
    {
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->gender = '';
        $this->lrn = '';
        $this->classroom_id = null;
        $this->status = null;
    }
}
