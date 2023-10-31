<?php

namespace App\Http\Livewire\Student;

use Carbon\Carbon;
use App\Models\Action;
use Livewire\Component;
use App\Models\Anecdotal;
use Illuminate\Support\Str;
use App\Models\Notification;
use Livewire\WithFileUploads;
use App\Models\AnecdotalImages;
use App\Models\AnecdotalOutcome;
use Illuminate\Support\Facades\Auth;
use App\Models\ScheduledNotification;
use App\Notifications\StatusNotification;
use App\Notifications\AdminDelayedNotification;

class ReportUpdate extends Component
{
    use WithFileUploads;
    public $outcome;
    public $story;
    public $outcome_remarks;
    public $action;
    public $anecdotal;
    public $anecdotalData;
    public $showMeetingOutcomeForm = false;
    public $reminderDays;
    public $letter = [];

    protected $rules = [
        'outcome' => 'required',
        'outcome_remarks' => 'required',
        'action' => 'required',
    ];


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


    public function mount($anecdotal)
    {
        $this->anecdotal = $anecdotal;
        $this->anecdotalData = Anecdotal::findOrFail($anecdotal);

        $this->outcome = $this->anecdotalData->actions->outcome;
        $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
        $this->action = $this->anecdotalData->actions->action;

        if ($this->anecdotalData->case_status == 1 || $this->anecdotalData->case_status == 2
        || $this->anecdotalData->case_status == 3) {
            $this->showMeetingOutcomeForm = true;
            $this->outcome = $this->anecdotalData->actions->outcome;
            $this->outcome_remarks = $this->anecdotalData->actions->outcome_remarks;
            $this->action = $this->anecdotalData->actions->action;

        }
    }
    public function update()
    {
        $this->validate();
        $anecdotalOutcome = AnecdotalOutcome::where('anecdotal_id',
        $this->anecdotalData->id)
            ->firstOrFail();

        $anecdotalOutcome->update([
            'action' => $this->action,
            'outcome' => $this->outcome,
            'outcome_remarks' => $this->outcome_remarks,
        ]);

        if ($this->outcome ==  2) {
            $this->anecdotalData->update(['case_status' => 2]);
        } elseif ($this->outcome == 3) {
            $this->anecdotalData->update(['case_status' => 3]);
        } elseif ($this->outcome == 4) {
            $this->anecdotalData->update(['case_status' => 4]);
        }




        $this->anecdotalData = $this->anecdotalData->fresh();

        // Remider about the case
        $user = Auth::user();
        $message = 'Reminder for ' . $anecdotalOutcome->anecdotal->students->first_name . '  ' . $anecdotalOutcome->anecdotal->students->last_name .
            'case, that resolved last ' . $anecdotalOutcome->updated_at->format('F j, Y');

        $data = [
            'message' => $message,
            'link' => $anecdotalOutcome->anecdotal->students->id
        ];

        $notification = new ScheduledNotification([

            'user_id' => $user->id,
            'data' => json_encode($data),
        ]);
        $notification->created_at = $this->reminderDays;
        $notification->save();
        session()->flash('message', 'Updated Successfully');
    }

    public function render()
    {
        return view('livewire.student.report-update', [
            'anecdotalData' => $this->anecdotalData,
        ])->extends('layouts.dashboard.index')->section('content');
    }

    public function saveLetters()
    {
        // Validate and store the uploaded files
        $this->validate([
            'letter' => 'nullable',
            'letter.*' => 'image|max:2048',
            // Adjust max file size as needed
        ]);

        foreach ($this->letter as $file) {
            $filename = $file->store('uploads', 'public'); // You may need to configure the storage path

            // Create a new record in the 'anecdotalImages' table
            AnecdotalImages::create([
                'anecdotal_id' => $this->anecdotalData->id,
                'images' => $filename,
            ]);
        }

        // Clear the uploaded files after saving
        $this->reset('letter');

        session()->flash('message', 'Letters have been saved successfully.');
    }


}
