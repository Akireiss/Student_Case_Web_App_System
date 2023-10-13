<?php

namespace App\Http\Livewire\Adviser;

use App\Models\User;
use App\Notifications\RefferNotification;
use Livewire\Component;
use App\Models\Students;
use App\Models\Classroom;
use App\Traits\StudentTrait;

class ReferStudent extends Component
{
    use StudentTrait;
    public $student;

    public function mount($student)
    {
        $student = Students::findOrFail($student);
        $this->student = $student;
        $this->first_name = $student->first_name;
        $this->middle_name = $student->middle_name;
        $this->last_name = $student->last_name;
        $this->lrn = $student->lrn;
        $this->classroom_id = $student->classroom_id;
        $this->status = $student->status;
    }


    public function update()
{
    $this->validate();
    $student = $this->student;

    $student->update([
        'first_name' => $this->first_name,
        'middle_name' => $this->middle_name,
        'last_name' => $this->last_name,
        'lrn' => $this->lrn,
        'classroom_id' => $this->classroom_id,
        'status' => $this->status,
    ]);

    $adminUsers = User::where('role', 1)->get();

    // Send notification to each admin user
    foreach ($adminUsers as $adminUser) {
        $adminUser->notify(new RefferNotification($this->student));
    }

    session()->flash('message', 'Student updated successfully.');
}


    public function render()
    {
        $currentGradeLevel = $this->student->classroom->grade_level;
        $nextGradeLevel = $currentGradeLevel + 1;

        $classrooms = Classroom::whereIn('grade_level', [$currentGradeLevel, $nextGradeLevel])->get();

        return view('livewire.adviser.refer-student', [
            'student' => $this->student,
            'classrooms' => $classrooms
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function view($student) {
        $student = Students::findOrFail($student);
        return view('staff.students.view',compact('student'));
    }
}
