<?php

namespace App\Http\Livewire\Adviser;

use App\Models\ActionsTaken;
use App\Models\Anecdotal;
use App\Models\Students;
use App\Models\User;
use App\Models\Action;
use App\Traits\SelectNameTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Offenses;
use App\Http\Livewire\Admin\Student;
use Livewire\WithFileUploads;

class Report extends Component
{

    use WithFileUploads;
    use SelectNameTrait;
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

        $userId = Auth::id();
        if (!is_null($userId)) {
            $anecdotal->report()->create([
                'user_id' => $userId,
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
        $this->selectedActions = [];
    }


}
