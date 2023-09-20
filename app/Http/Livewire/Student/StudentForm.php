<?php

namespace App\Http\Livewire\Student;

use App\Models\EducBg;
use App\Models\Profile;
use App\Traits\SelectAddressTrait;
use Livewire\Component;
use App\Models\Students;
use App\Traits\SelectNameTrait;

class StudentForm extends Component
{
    public $studentName = '';
    public $studentId = null;
    public $isOpen = false;
    public $showError = false;

    use SelectAddressTrait;
    public $showCreateLink = false;

    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
        $this->isOpen = false;

        $profile = Profile::where('student_id', $id)->first();

        if ($profile) {
            $this->resetErrorBag();
            return redirect()->route('student.login', $profile->id);
            // return redirect()->route('student.profile.data', $profile->id);
        } else {
            $this->addError('studentId', 'This student has no profile. You can create a profile for this student.');
            $this->showCreateLink = true;
        }
    }
    public function render()
    {
        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        return view('livewire.student.student-form', [
            'students' => $students,
        ])->extends('layouts.app')
            ->section('content');
    }

    public function resetForm()
    {
        $this->studentName = '';
        $this->studentId = null;
        $this->cases = [];
        $this->resetErrorBag(['studentId']);
    }

    public function clearStudent()
    {
        $this->studentId = null;
        $this->studentName = '';
        $this->isOpen = false;
        $this->resetErrorBag();
    }
}
