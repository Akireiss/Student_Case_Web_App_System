<?php

namespace App\Http\Livewire\Student;

use Carbon\Carbon;
use App\Models\Action;
use Livewire\Component;
use App\Models\Anecdotal;
use App\Models\AnecdotalOutcome;
use App\Notifications\StatusNotification;

class ReportUpdate extends Component
{

    public $outcome;
    public $story;
    public $outcome_remarks;
    public $actions_id;
    public $anecdotal;
    public $anecdotalData;
    public $showMeetingOutcomeForm = false;
    public $reminderDays;

    public function mount($anecdotal)
    {
        $this->anecdotal = $anecdotal;
        $this->anecdotalData = Anecdotal::findOrFail($anecdotal);
        $this->outcome = $this->anecdotalData->actions->outcome;
        $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
        $this->actions_id = $this->anecdotalData->actions->actions_id;

        if ($this->anecdotalData->case_status == 1 || $this->anecdotalData->case_status == 2) {
            $this->showMeetingOutcomeForm = true;
            $this->outcome = $this->anecdotalData->actions->outcome;
            $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
            $this->actions_id = $this->anecdotalData->actions->actions_id;

        }
    }

    public function acceptAnecdotal()
    {
        $this->anecdotalData->update(['case_status' => 1]);
        $this->anecdotalData = $this->anecdotalData->fresh();
        $this->showMeetingOutcomeForm = true;

        $report = $this->anecdotalData->report->first();

        if ($report) {
            $user = $report->user;
            if ($user) {
                $user->notify(new StatusNotification($this->anecdotalData));
            }
        }

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

        $this->anecdotalData->update(['case_status' => 2]);
        $this->anecdotalData = $this->anecdotalData->fresh();

        session()->flash('message', 'Updated Successfully');

        // Send the notification to the authenticated user
        $user = auth()->user();
        $user->notify(new StatusNotification($this->reminderDays));
    }

    public function scheduleReminder($reminderDays)
    {
        $manilaTimeZone = 'Asia/Manila';
        Carbon::setTestNow(Carbon::now($manilaTimeZone));
        $reminderTime = Carbon::now()->addDays($reminderDays);
        auth()->user()->notify((new StatusNotification($this->reminderDays))->delay($reminderTime));
        Carbon::setTestNow();
    }



    public function render()
    {
        $actions = Action::all();
        return view('livewire.student.report-update', [
            'anecdotalData' => $this->anecdotalData,
            'actions' => $actions
        ])->extends('layouts.dashboard.index')->section('content');
    }

}
