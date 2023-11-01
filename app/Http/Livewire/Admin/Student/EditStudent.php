<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Classroom;
use App\Models\Students;
use App\Traits\StudentTrait;
use Livewire\Component;

class EditStudent extends Component
{
    use StudentTrait;
    public $student;

    public function mount($student)
    {
        $this->student = $student;
        $student = Students::findOrFail($student);
        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->first_name;
        $this->lrn = $student->lrn;
        $this->status = $student->status;
        $this->classroom_id = $student->classroom_id;
    }


    public function update()
    {
        $this->validate();

        $studentModel = Students::findOrFail($this->student);
        $studentModel->update([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'lrn' => $this->lrn,
            'status' => $this->status,
            'classroom_id' => $this->classroom_id,
        ]);

        session()->flash('message', 'Student updated successfully.');
    }

    public function view($student)
    {
        $student = Students::findOrFail($student);
        return view('admin.settings.students.view', compact('student'));
    }

    public function deleteStudent($studentId)
    {
        $student = Students::find($studentId);
        if (!$student) {
            return redirect()->to('admin/settings/students');
        }
        $student->delete();

    }


    public function render()
    {
        $classrooms = Classroom::all();
        return view('livewire.admin.student.edit-student', [
            'student' => $this->student,
            'classrooms' => $classrooms,
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

}
