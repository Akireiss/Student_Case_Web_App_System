<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Report;
use Livewire\Component;
use App\Models\Offenses;
use App\Models\Students;
use App\Models\Anecdotal;
use App\Traits\SelectNameTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ReportHistory extends Component
{
   use SelectNameTrait;
   use WithFileUploads;
    public $reportId;
    public function view($id)
    {
        $report = Report::findOrFail($id);
        if($report->user_id != auth()->user()->id)
        {
            abort(403);
        }
        return view('staff.report-history.view', compact('report'));
    }

    public function mount($report) {
    $this->reportId = $report;
    }

    public function render() {
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

        $report = Report::findOrFail($this->reportId);
        if($report->user_id != auth()->user()->id)
        {
            abort(403);
        }
        return view('livewire.adviser.report-history', compact('report', 'graveOffenses', 'minorOffenses', 'students'))
        ->extends('layouts.dashboard.index')->section('content');
    }

    public function update() {
        $letterPath = null;

        if ($this->letter) {
            $letterPath = $this->letter->store('uploads', 'public');
        }

        $anecdotal = Anecdotal::update([
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
            $anecdotal->actionsTaken()->update([
                'actions' => $selectedAction
            ]);
        }

        $userId = Auth::id();
        if (!is_null($userId)) {
            $anecdotal->report()->update([
                'user_id' => $userId,
            ]);
        }

        $this->resetForm();
        session()->flash('message', 'Updated Successfully');
    }





}
