<?php

namespace App\Http\Livewire\Admin\Classroom;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Classroom;

class ClassroomUpdate extends Component
{
    public $classroom;
    public $grade_level;
    public $section;
    public $employee_id;
    public $status;

    public function mount($classroom) {
        $this->classroom = $classroom;
        $classroom = Classroom::findOrFail($classroom);
        $this->grade_level = $classroom->grade_level;
        $this->section = $classroom->section;
        $this->employee_id = $classroom->employee_id;
        $this->status = $classroom->status;
    }

    protected function rules()
    {
        return [
            'grade_level' => 'required',
            'section' => 'required',
            'employee_id' => 'required',
            'status' => 'required',
        ];
    }

    public function updateClassroom()
    {
        $this->validate();

        $classroomModel = Classroom::findOrFail($this->classroom);
        $classroomModel->update([
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'employee_id' => $this->employee_id,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Classroom updated successfully.');
    }

    public function render()
    {
        $employees = Employee::pluck('employees', 'id');
        return view('livewire.admin.classroom.classroom-update', compact('employees'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }
}
