<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;

class Teacher extends Component
{
    public $employees;
    public $refference_number;
    public $status;

    protected $rules = [
        'employees' => 'required|string|max:255',
        'refference_number' => 'required|string|max:255',
        'status' => 'required|in:0,1',
    ];

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
