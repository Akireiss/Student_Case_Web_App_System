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
    public $selectedActions = [];

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

    protected $rules = [
        'studentName' => 'required',
        'studentId' => 'required',
        'minor_offenses_id' => 'nullable|required_without_all:grave_offenses_id',
        'grave_offenses_id' => 'nullable|required_without_all:minor_offenses_id',
        'gravity' => 'required',
        'short_description' => 'required',
        'observation' => 'required',
        'desired' => 'required',
        'outcome' => 'required',
        'letter' => 'nullable | image',
        'selectedActions' => 'required',
    ];

    protected $messages = [
        'studentId' => 'Please select student',
        'minor_offenses_id.required_without_all' => 'Please select at least one minor Offense or provide a grave Offense.',
        'grave_offenses_id.required_without_all' => 'Please select at least one grave Offense or provide a minor Offense.',
        'selectedActions.required' => 'Please select at least one action.',
    ];


    public function selectStudent($id, $name)
    {
        $this->studentId = $id;
        $this->studentName = $name;
     //  !$this->last_name = Students::find($id)->last_name;(for the profile)
        $this->isOpen = false;
        $this->loadCases();

    }
    public function loadCases()
    {
        if ($this->studentId) {
            $student = Students::find($this->studentId);
            if ($student) {
                $this->cases = $student->anecdotal;
            } else {
                $this->cases = [];
            }
        } else {
            $this->cases = [];
        }
    }
    public function updatedStudentId()
    {
        $this->loadCases();
    }
    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
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
    public function mount()
    {
        $this->showError = false;
        $this->loadCases();
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
        $actions = Action::all();
        $offenses = Offenses::whereIn('category', [0, 1])->get();
        $minorOffenses = $offenses->where('category', 0)->pluck('offenses', 'id');
        $graveOffenses = $offenses->where('category', 1)->pluck('offenses', 'id');

        return view('livewire.adviser.report', [
            'minorOffenses' => $minorOffenses,
            'graveOffenses' => $graveOffenses,
            'students' => $students,
            'actions' => $actions
        ])->extends('layouts.dashboard.index')
            ->section('content');
    }



    public function store()
    {
        $this->validate();
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

        foreach ($this->selectedActions as $selectedAction) {
            $anecdotal->actionsTaken()->create([
                'actions' => $selectedAction
            ]);
        }


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
        $this->studentName = null;
        $this->studentId = null;
        $this->gravity = '';
        $this->short_description = '';
        $this->observation = '';
        $this->desired = '';
        $this->outcome = '';
        $this->minor_offenses_id = null;
        $this->grave_offenses_id = null;
        $this->letter = null;
        $this->selectedActions= [];

    }
    public function resetSelect($selectedField)
    {
        if ($selectedField === 'minor') {
            if ($this->minor_offenses_id === '') {
                $this->minor_offenses_id = null;
                return;
            }
            // No need to reset the value if an actual option is selected
        } elseif ($selectedField === 'grave') {
            if ($this->grave_offenses_id === '') {
                $this->grave_offenses_id = null;
                return;
            }
        }
    }
}
