<?php

namespace App\Http\Livewire\Student;

use App\Models\ScheduledNotification;
use Carbon\Carbon;
use App\Models\Action;
use Livewire\Component;
use App\Models\Anecdotal;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\AnecdotalOutcome;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StatusNotification;
use App\Notifications\AdminDelayedNotification;

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


            $user = Auth::user();

            $data = [
                'message' => 'sample data',
            ];

            // Calculate the notification date based on the reminder days
            $notificationDate = now()->addDays($this->reminderDays);

            // Create a new notification and save it to the database
            $notification = new ScheduledNotification([

                'user_id' => $user->id,
                'data' => json_encode($data),
            ]);

            // Set the 'created_at' attribute to the calculated notification date
            $notification->created_at = $notificationDate;

            $notification->save();

        session()->flash('message', 'Updated Successfully');



    }

    public function render()
    {
        return view('livewire.student.report-update', [
            'anecdotalData' => $this->anecdotalData,
        ])->extends('layouts.dashboard.index')->section('content');
    }

}
