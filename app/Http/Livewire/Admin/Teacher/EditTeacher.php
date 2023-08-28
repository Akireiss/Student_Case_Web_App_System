<?php

namespace App\Http\Livewire\Admin\Teacher;

use App\Traits\TeacherTrait;
use Livewire\Component;
use App\Models\Employee;

class EditTeacher extends Component
{
    use TeacherTrait;
    public $employee;

    public function mount($employee)
    {
        $this->employee = $employee;
        $employee = Employee::findOrFail($employee);
        $this->employees = $employee->employees;
        $this->refference_number = $employee->refference_number;
        $this->status = $employee->status;
    }
    public function render()
    {
        return view('livewire.admin.teacher.edit-teacher', [
            'employee' => $this->employee,
        ])
        ->extends('layouts.dashboard.index')->section('content');
    }
    public function update()
    {
        $this->validate();
        $employee= Employee::findOrFail($this->employee);
        $employee->update([
            'employees' => $this->employees,
            'refference_number' => $this->refference_number,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Employee updated successfully.');
    }

    public function view($employee) {
        $employee = Employee::findOrFail($employee);
    return view('admin.settings.teachers.view', compact('employee'));
    }

}
