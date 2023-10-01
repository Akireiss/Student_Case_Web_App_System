<?php

namespace App\Http\Livewire\Admin;

use App\Traits\TeacherTrait;
use Livewire\Component;
use App\Models\Employee;

class Teacher extends Component
{

    use TeacherTrait;
    public function render()
    {
        return view('livewire.admin.teacher')
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function store()
    {
        $this->validate();

        Employee::create([
            'employees' => $this->employees,
            'refference_number' => $this->refference_number,
            'status' => $this->status,
        ]);

        $this->resetForm();
        session()->flash('message', 'Successfully Added');
    }

    private function resetForm()
    {
        $this->employees = '';
        $this->refference_number = '';
        $this->status = '';
    }
}
