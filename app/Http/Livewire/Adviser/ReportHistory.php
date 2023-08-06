<?php

namespace App\Http\Livewire\Adviser;

use App\Models\Report;
use Livewire\Component;

class ReportHistory extends Component
{
    public function render()
    {
        $user = auth()->user();
        $userReports = $user->reports()->latest()->get();
        return view('livewire.adviser.report-history', compact('userReports'))
        ->extends('layouts.dashboard.index')->section('content');
    }
    public function show($id)
    {
        $report = Report::findOrFail($id);
        if($report->user_id != auth()->user()->id)
        {
            abort(403);
        }
        return view('staff.report-history.view', compact('report'));
    }
}
