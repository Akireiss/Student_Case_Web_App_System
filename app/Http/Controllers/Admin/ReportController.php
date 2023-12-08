<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anecdotal;
use App\Models\Students;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function view(Anecdotal $anecdotal)
    {
        $cases = Anecdotal::where('student_id', $anecdotal->student_id)
            ->latest('created_at')
            ->get();

        $totalCases = $cases->count();
        $pendingCases = $cases->where('case_status', 0)->count();
        $ongoingCases = $cases->where('case_status', 1)->count();
        $resolvedCases = $cases->where('case_status', 2)->count();
        $followCases = $cases->where('case_status', 3)->count();
        $refferalCases = $cases->where('case_status', 4)->count();

        return view('admin.reports.view',
            compact('anecdotal', 'cases', 'totalCases', 'pendingCases', 'ongoingCases', 'resolvedCases', 'followCases', 'refferalCases')
        );
    }

    public function index()
    {
        return view('admin.reports.index');
    }

    public function recentCases(Request $request, $id)
    {
        $students = Students::findOrFail($id);

        $anecdotalRecords = $students->anecdotal->filter(function ($anecdotal) {
            $latestOutcome = $anecdotal->outcomes->first();
            return $anecdotal->created_at >= $latestOutcome->updated_at;
        });

        return view('admin.reports.receent-cases', compact('anecdotalRecords', 'students'));
    }


}
