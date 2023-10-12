<?php

namespace App\Http\Livewire\Admin\Classroom;

use Livewire\Component;
use App\Models\Employee;

class Classroom extends Component
{
    public $grade_level;
    public $section;
    public $employee_id;
    public $status;

    protected $rules = [
            'employee_id' => 'required',
            'section' => 'required',
            'grade_level' => 'required',
            'status' => 'required',
        ];


    public function render()
    {
        $employees = Employee::pluck('employees', 'id');
        return view('livewire.admin.classroom', compact('employees'))
        ->extends('layouts.dashboard.index')
        ->section('content');
    }

    public function saveClassroom()
    {
        $this->validate();

        \App\Models\Classroom::create([
            'employee_id' => $this->employee_id,
            'section' => $this->section,
            'grade_level' => $this->grade_level,
            'status' => $this->status,
        ]);
        $this->resetFormFields();
        session()->flash('message', 'Classroom saved successfully.');
    }

    private function resetFormFields()
    {
        $this->employee_id = '';
        $this->section = '';
        $this->grade_level = '';
        $this->status = '';
    }

    //View Classroom
    public function view($classroom) {

        $classroom = \App\Models\Classroom::findOrFail($classroom);
        return view('admin.settings.classrooms.view', compact('classroom'));
    }

}
