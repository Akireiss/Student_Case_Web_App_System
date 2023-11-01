<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Report;
use App\Models\Actions;
use Livewire\Component;
use App\Models\Offenses;
use App\Models\Students;
use App\Models\Anecdotal;
use App\Models\ActionsTaken;
use Livewire\WithFileUploads;
use App\Models\AnecdotalImages;
use App\Traits\SelectNameTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportHistory extends Component
{
    use SelectNameTrait;
    use WithFileUploads;

    public $offense_id;
    public $user_id;
    public $observation;
    public $desired;
    public $outcome;
    public $gravity;
    public $short_description;
    public $reportId;
    public $description;
    public $image;
    public $story;
    public $selectedActions = [];

    public $grade_level;
    public $gravityOptions = [
        0 => 'Low Severity',
        1 => 'Moderate Severity',
        2 => 'Medium Severity',
        3 => 'High Severity',
        4 => 'Critical Severity',
    ];



    public function mount($report)
    {
        $this->reportId = $report;
        $reportData = Report::findOrFail($report);
        $anecdotal = Report::findOrFail($report)->anecdotal;
        $this->observation = $anecdotal->observation;
        $this->desired = $anecdotal->desired;
        $this->outcome = $anecdotal->outcome;
        $this->gravity = $anecdotal->gravity;
        $this->offense_id = $anecdotal->offense_id;
        $this->short_description = $anecdotal->short_description;
        $this->letter = $anecdotal->letter;
        $this->story = $anecdotal->story;
        $this->grade_level = $anecdotal->grade_level;
        $this->studentId = $anecdotal->student->id;
        $this->studentName = $anecdotal->student->first_name . ' ' . $anecdotal->student->last_name;
        $this->user_id = $reportData->users->name;

        $actionsTaken = $reportData->anecdotal->actionsTaken;
        if ($actionsTaken->count() > 0) {
            $this->selectedActions = $actionsTaken->pluck('actions')->toArray();
        }

    }


    public function update()
    {
        $report = Report::findOrFail($this->reportId);

        $report->anecdotal->update([
            'student_id' => $this->studentId,
            'offense_id' => $this->offense_id,
            'observation' => $this->observation,
            'desired' => $this->desired,
            'outcome' => $this->outcome,
            'gravity' => $this->gravity,
            'story' => $this->story,
            'short_description' => $this->short_description,
        ]);

        // foreach ($this->images as $image) {
        //     $path = $image->store('uploads', 'public');

        //     $report->anecdotal->images()->create([
        //         'images' => $path,
        //     ]);
        // }

        $report->anecdotal->actionsTaken()->delete();
        foreach ($this->selectedActions as $selectedAction) {
            $report->anecdotal->actionsTaken()->create(['actions' => $selectedAction]);
        }

        session()->flash('message', 'Report updated successfully.');
    }

    //Delete Image
    public function deleteImage($imageId)
    {
        $image = AnecdotalImages::find($imageId);

        if ($image) {
            $filename = $image->images;
            $filePath = 'uploads/' . $filename;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Delete the image record from the database
            $image->delete();
            $this->emit('imageDeleted');
        }
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

    $offenses = Offenses::pluck('offenses', 'id')->all();
    $actions = Actions::all();
    $report = Report::findOrFail($this->reportId);
    if ($report->user_id != auth()->user()->id) {
        abort(403);
    }
    return view('livewire.adviser.report-history', compact('report', 'offenses', 'actions', 'students'))
        ->extends('layouts.dashboard.index')->section('content');
}

public function view($id)
{
    $report = Report::findOrFail($id);
    if ($report->user_id != auth()->user()->id) {
        abort(403);
    }
    $anecdotal = $report->anecdotal;
    return view('staff.report-history.view', compact('report'));
}
}
