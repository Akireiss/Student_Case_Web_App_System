<?php

namespace App\Http\Livewire\Adviser;

use App\Http\Requests\StudentFormRequest;
use App\Models\ActionsTaken;
use App\Models\Anecdotal;
use App\Models\Students;
use App\Models\User;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Offenses;
use App\Http\Livewire\Admin\Student;
use Livewire\WithFileUploads;

class Report extends Component
{
    public $studentName = '';
    public $studentId = null;
    public $isOpen = false;
    public $showError = false;
    public $cases = [];
    public $actions;

    use WithFileUploads;
    public $minor_offenses_id;
    public $grave_offenses_id;
    public $gravity;
    public $short_description;
    public $observation;
    public $desired;
    public $outcome;
    public $letter;

    public $user_id;

    public function mount()
    {
        $this->showError = false;
    }

    public function selectStudent($id, $name)
    {

        $this->studentId = $id;
        $this->studentName = $name;
        //  $this->last_name = Students::find($id)->last_name;
        $this->isOpen = false;
        $student = Students::find($id);
        if ($student) {
            $this->cases = $student->anecdotal;
        } else {
            $this->cases = [];
        }

    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen; // Toggle the dropdown visibility.
    }

    public function updatedStudentName($value)
    {
        if (empty($value)) {
            $this->resetForm();
        }
    }

    public function updated()
    {
        $this->showError = false;
    }


    public function store()
    {
        if (empty($this->studentId)) {
            $this->addError('studentId', 'Please select a student');
            $this->showError = true;
            return;
        }

        $letterPath = null;

        if ($this->letter) {
            $letterPath = $this->letter->store('uploads', 'public');
        }

        $anecdotal = Anecdotal::create([
            'student_id' => $this->studentId,
            'minor_offense_id' => $this->minor_offenses_id,
            'grave_offense_id' => $this->grave_offenses_id,
            'gravity' => $this->gravity,
            'short_description' => $this->short_description,
            'observation' => $this->observation,
            'desired' => $this->desired,
            'outcome' => $this->outcome,
            'letter' => $letterPath,
        ]);

        $anecdotal->actionsTaken()->create([
            'actions' => $this->actions
        ]);

        $loggedInUserId = Auth::id();

        if (!is_null($loggedInUserId)) {
            $anecdotal->report()->create([
                'user_id' => $loggedInUserId,
            ]);
        }
        $this->resetForm();
        session()->flash('message', 'Successfully Added');
    }

    public function resetForm()
    {
        $this->studentName = '';
        $this->studentId = '';
    }

    public function render()
    {
        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        $offenses = Offenses::whereIn('category', [0, 1])->get();
        $minorOffenses = $offenses->where('category', 0)->pluck('offenses', 'id');
        $graveOffenses = $offenses->where('category', 1)->pluck('offenses', 'id');

        return view('livewire.adviser.report', [
            'minorOffenses' => $minorOffenses,
            'graveOffenses' => $graveOffenses,
            'students' => $students
        ])->extends('layouts.dashboard.index')
        ->section('content');
    }


}
