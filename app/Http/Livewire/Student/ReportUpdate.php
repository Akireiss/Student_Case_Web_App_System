<?php

namespace App\Http\Livewire\Student;

use App\Models\Action;
use App\Models\AnecdotalOutcome;
use Livewire\Component;
use App\Models\Anecdotal;

class ReportUpdate extends Component
{

    public $outcome;
    public $outcome_remarks;
    public $actions_id;
    public $anecdotal;
    public $anecdotalData;
    public $showMeetingOutcomeForm = false;
    public $buttonText = 'Accept';
    public $statusText = 'Accepting it will update the status to ongoing';
    public function mount($anecdotal)
    {
        $this->anecdotal = $anecdotal;
        $this->anecdotalData = Anecdotal::findOrFail($anecdotal);

        if ($this->anecdotalData->case_status == 1) {
            $this->showMeetingOutcomeForm = true;
            $this->buttonText = 'Ongoing';
            $this->statusText = 'Working on it';
        }
    }

    public function acceptAnecdotal()
    {
        $this->anecdotalData->update(['case_status' => 1]);
        $this->anecdotalData = $this->anecdotalData->fresh();
        $this->showMeetingOutcomeForm = true;
        $this->buttonText = 'Ongoing';
    }


    public function update() {
        AnecdotalOutcome::create([
            'anecdotal_id' => $this->anecdotal,
            'actions_id' => $this->actions_id,
            'outcome' => $this->outcome,
            'outcome_remarks' => $this->outcome_remarks,
        ]);
        session()->flash('message', 'Updated Successfully');

    }

    public function render()
    {
        $actions = Action::all();
        return view(
            'livewire.student.report-update',
            [
                'anecdotalData' => $this->anecdotalData,
                'actions' => $actions
            ]
        )->extends('layouts.dashboard.index')->section('content');
    }

}
