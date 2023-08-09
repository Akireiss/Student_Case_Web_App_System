<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Report;
use Livewire\Component;
use App\Models\Offenses;
use App\Models\Students;
use App\Traits\SelectNameTrait;

class ReportHistory extends Component
{
    use SelectNameTrait;
    public function render()
    {
        return view('livewire.adviser.report-history')
        ->extends('layouts.dashboard.index')->section('content');
    }
    public function view($id)
    {
        $report = Report::findOrFail($id);
        if($report->user_id != auth()->user()->id)
        {
            abort(403);
        }
        return view('staff.report-history.view', compact('report'));
    }

    public function edit($id) {
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

        $report = Report::findOrFail($id);
        if($report->user_id != auth()->user()->id)
        {
            abort(403);
        }
        return view('staff.report-history.edit', compact('report', 'graveOffenses', 'minorOffenses', 'students'));
    }


}
