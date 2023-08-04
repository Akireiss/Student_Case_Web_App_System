<?php

namespace App\Http\Controllers\Adviser;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportHistoryController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $userReports = $user->reports()->latest()->get();
    return view('staff.report-history.index', compact('userReports'));
}

public function show($id)
{
    $report = Report::findOrFail($id);
    $this->authorize('view', $report);
    return view('staff.report-history.view', compact('report'));
}




}
