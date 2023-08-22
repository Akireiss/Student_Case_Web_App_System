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



    public function mount($anecdotal)
    {
        $this->anecdotal = $anecdotal;
        $this->anecdotalData = Anecdotal::findOrFail($anecdotal);
        $this->outcome = $this->anecdotalData->actions->outcome ?? '';
        $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks ?? '';
        $this->actions_id = $this->anecdotalData->actions->actions_id ?? null;

        if ($this->anecdotalData->case_status == 1) {
            $this->showMeetingOutcomeForm = true;
        }
    }

    public function acceptAnecdotal()
    {
        $this->anecdotalData->update(['case_status' => 1]);
        $this->anecdotalData = $this->anecdotalData->fresh();
        $this->showMeetingOutcomeForm = true;
    }


    public function update()
    {
        $anecdotalOutcome = AnecdotalOutcome::where('anecdotal_id', $this->anecdotalData->id)
            ->firstOrFail();

        $anecdotalOutcome->update([
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
