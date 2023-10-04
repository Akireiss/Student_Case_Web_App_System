<?php

namespace App\Http\Livewire\Student;


use App\Models\Anecdotal;
use App\Models\Students;
use App\Models\Action;
use App\Traits\SelectNameTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Offenses;
use Livewire\WithFileUploads;

class Report extends Component
{
    //test
    public $offense_id;
    public $observation;
    public $desired;
    public $outcome;
    public $letter  = [];
    public $user_id;
    public $classroom;
    public $grade_level;
    public $gravity;
    public $short_description;
    public $cases = [];
    public $selectedActions = [];
    public $story;
    public $actions_id = null;
    public $outcome_update = null;
    public $outcome_remarks = null;


    use WithFileUploads;
    use SelectNameTrait;
    protected $rules = [
        'studentName' => 'required',
        'studentId' => 'required',
        'offense_id' => 'required',
        'gravity' => 'required',
        'short_description' => 'nullable',
        'observation' => 'required',
        'desired' => 'nullable',
        'outcome' => 'required',
        'letter' => 'nullable',
        'selectedActions' => 'required',
        'story' => 'required',
    ];

    protected $messages = [
        'studentId' => 'This field is required',
        'offense_id' => 'This field is required',
        'selectedActions.required' => 'Please select at least one action.',
    ];

    public function loadCases()
    {
        if ($this->studentId) {
            $student = Students::find($this->studentId);
            if ($student) {
                $this->cases = $student->anecdotal;
            } else {
                $this->cases = [];
            }
        }
    }

    public function updatedStudentId()
    {
        $this->loadCases();
    }

    public function render()
    {
        $students = [];

        if (strlen($this->studentName) >= 3) {
            $students = Students::whereIn('status', [0, 2])->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->studentName . '%')
                    ->orWhere('last_name', 'like', '%' . $this->studentName . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $this->studentName . '%']);
            })->get();
        }

        $actions = Action::all();
        $offenses = Offenses::pluck('offenses', 'id')->all();

        return view('livewire.student.report', [
            'offenses' => $offenses,
            'students' => $students,
            'actions' => $actions
        ])->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function store()
    {
        $this->validate();



        $anecdotal = Anecdotal::create([
            'student_id' => $this->studentId,
            'offense_id' => $this->offense_id,
            'gravity' => $this->gravity,
            'short_description' => $this->short_description,
            'observation' => $this->observation,
            'desired' => $this->desired,
            'outcome' => $this->outcome,
            'grade_level' => $this->classroom->section . ' ' . $this->classroom->grade_level ?? '',
            'story' => $this->story,
        ]);

        foreach ($this->letter as $file) {
            $path = $file->store('uploads', 'public');

            // Create a record in the anecdotal_images table
            $anecdotal->images()->create([
                'images' => $path,
            ]);
        }


        $anecdotal->actions()->create([
            'actions_id' => $this->actions_id,
            'outcome' => $this->outcome_update,
            'outcome_remarks' => $this->outcome_remarks,
        ]);



        foreach ($this->selectedActions as $selectedAction) {
            $anecdotal->actionsTaken()->create([
                'actions' => $selectedAction
            ]);
        }


        $userId = Auth::id();
        if (!is_null($userId)) {
            $anecdotal->report()->create([
                'user_id' => $userId,
            ]);
        }

        $this->resetReport();
        session()->flash('message', 'Successfully Added');
    }


    public function resetReport()
    {
        $this->studentName = null;
        $this->studentId = null;
        $this->gravity = '';
        $this->short_description = '';
        $this->observation = '';
        $this->desired = '';
        $this->outcome = '';
        $this->story = '';
        $this->grade_level = '';
        $this->classroom = '';
        $this->offense_id = null;
        $this->path = [];
        $this->selectedActions = [];
    }

    public function resetForm()
    {
        $this->studentName = '';
        $this->studentId = null;
        $this->cases = [];
        $this->resetErrorBag(['studentId']);
    }

}
