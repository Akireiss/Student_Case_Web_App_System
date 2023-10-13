<?php

namespace App\Http\Livewire\Student;

use App\Notifications\AdminDelayedNotification;
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
    public $action;
    public $anecdotal;
    public $anecdotalData;
    public $showMeetingOutcomeForm = false;
    public $reminderDays;

    protected $rules = [
        'outcome' => 'required',
        'outcome_remarks' => 'required',
        'action' => 'required',
    ];
    public function mount($anecdotal)
    {
        $this->anecdotal = $anecdotal;
        $this->anecdotalData = Anecdotal::findOrFail($anecdotal);
        $this->outcome = $this->anecdotalData->actions->outcome;
        $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
        $this->action = $this->anecdotalData->actions->action;

        if ($this->anecdotalData->case_status == 1 || $this->anecdotalData->case_status == 2) {
            $this->showMeetingOutcomeForm = true;
            $this->outcome = $this->anecdotalData->actions->outcome;
            $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
            $this->action = $this->anecdotalData->actions->action;

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
        $this->validate();
        $anecdotalOutcome = AnecdotalOutcome::where('anecdotal_id', $this->anecdotalData->id)
            ->firstOrFail();

        $anecdotalOutcome->update([
            'action' => $this->action,
            'outcome' => $this->outcome,
            'outcome_remarks' => $this->outcome_remarks,
        ]);

        $this->anecdotalData->update(['case_status' => 2]);
        $this->anecdotalData = $this->anecdotalData->fresh();

        session()->flash('message', 'Updated Successfully');

        // Send the notification to the authenticated useryr
        $user = auth()->user();

        // Pass the $this->anecdotalData model instance to the notification
        $user->notify(new AdminDelayedNotification($this->anecdotalData, $this->reminderDays));
    }

    public function scheduleReminder($reminderDays)
    {
        $manilaTimeZone = 'Asia/Manila';
        Carbon::setTestNow(Carbon::now($manilaTimeZone));
        $reminderTime = Carbon::now()->addDays($reminderDays);

        // Call delay() on the notification, not on auth()->user()
        auth()->user()->notify((new AdminDelayedNotification($this->anecdotalData))->delay($reminderTime));

        Carbon::setTestNow();
    }


    public function render()
    {
        return view('livewire.student.report-update', [
            'anecdotalData' => $this->anecdotalData,
        ])->extends('layouts.dashboard.index')->section('content');
    }

}
