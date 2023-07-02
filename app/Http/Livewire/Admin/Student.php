<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\Students;

class Student extends Component
{
    public $status;
    public $first_name;
    public $last_name;
    public $lrn;
    public $classroom_id;
    public $successMessage = '';
    public $isSubmitting = false;

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'lrn' => 'required|numeric',
        'classroom_id' => 'required',
        'status' => 'required|in:0,1',
    ];

    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.admin.student', compact('classrooms'));
    }

    public function store()
    {
        $this->validate();

        $this->isSubmitting = true;

        // Save the student data to the database using the Student model
        Students::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'lrn' => $this->lrn,
            'classroom_id' => $this->classroom_id,
            'status' => $this->status,
        ]);

        $this->resetForm();
        session()->flash('message', 'Student Successfully Added');
        $this->isSubmitting = false;
    }


    private function resetForm()
    {
        // Add any logic to reset form fields if needed
        $this->first_name = '';
        $this->last_name = '';
        $this->lrn = '';
        $this->classroom_id = null;
        $this->status = null;
    }
}
