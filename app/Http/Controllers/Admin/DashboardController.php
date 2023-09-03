<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Students;
use App\Models\Anecdotal;
use Illuminate\Http\Request;
use App\Models\AnecdotalOutcome;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getDashboardData(Request $request)
    {
        $studentQuery = Students::where('status', 0);
        $caseQuery = Anecdotal::query();

        if ($request->input('time_range') === 'yearly') {
            $currentMonth = date('n');
            if ($currentMonth >= 8) { // August to December
                $studentQuery->whereBetween('created_at', [date('Y-08-01'), date('Y-12-31')]);
                $caseQuery->whereBetween('created_at', [date('Y-08-01'), date('Y-12-31')]);
            } else { // January to May
                $studentQuery->whereBetween('created_at', [date('Y-01-01'), date('Y-05-31')]);
                $caseQuery->where(function($query) {
                    $query->whereBetween('created_at', [date('Y-01-01'), date('Y-05-31')])
                          ->orWhereBetween('created_at', [date('Y-m-d', strtotime('-1 year', strtotime('August 1'))), date('Y-m-d', strtotime('-1 year', strtotime('May 31')))]);
                });
            }
        }

        $totalStudents = $studentQuery->count();
        $totalCases = $caseQuery->count();
        $pendingCases = $caseQuery->where('case_status', 0)->count();
        $resolvedCases = $caseQuery->where('case_status', 2)->count();

        return response()->json([
            'totalStudents' => $totalStudents,
            'totalCases' => $totalCases,
            'pendingCases' => $pendingCases,
            'resolvedCases' => $resolvedCases,
        ]);
    }


    public function getOffenseCounts()
    {
        $offenseCounts = DB::table('anecdotal')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select('offenses.offenses as offense', DB::raw('count(*) as count'))
            ->groupBy('offense')
            ->get();

        return response()->json($offenseCounts);
    }


    public function getCaseCounts()
    {
        $caseCounts = Anecdotal::selectRaw("DATE_FORMAT(created_at, '%M') as month, case_status, count(*) as count")
            ->groupBy('month', 'case_status')
            ->get();

        $data = [
            'pending' => [],
            'ongoing' => [],
            'resolved' => [],
        ];

        foreach ($caseCounts as $count) {
            $month = date('F', strtotime($count->month));

            if ($count->case_status === 0) {
                $data['pending'][$month] = $count->count;
            }
            else if ($count->case_status === 1) {
                $data['ongoing'][$month] = $count->count;
            } else if ($count->case_status === 2) {
                $data['resolved'][$month] = $count->count;
            }
        }

        return response()->json($data);
    }



    public function getWeeklyReportCount()
    {
        $startOfWeek = Carbon::now(new \DateTimeZone('Asia/Manila'))->startOfWeek();
        $endOfWeek = Carbon::now(new \DateTimeZone('Asia/Manila'))->endOfWeek();

        $weeklyReportCount = DB::table('anecdotal')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();

        return response()->json([
            'weeklyReportCount' => $weeklyReportCount,
        ]);
    }

    public function getMonthlyReportCount()
    {
        $startOfMonth = Carbon::now(new \DateTimeZone('Asia/Manila'))->startOfMonth();
        $endOfMonth = Carbon::now(new \DateTimeZone('Asia/Manila'))->endOfMonth();

        $monthlyReportCount = DB::table('anecdotal')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        return response()->json([
            'monthlyReportCount' => $monthlyReportCount,
        ]);
    }

    //*Resolved Cases

public function getResolvedCases()
{
    $twoWeeksAgo = Carbon::now()->subWeeks(2);
    $resolvedCount = Anecdotal::where('case_status', 2)
        ->where('case_status', 2)
        ->where('updated_at', '>', $twoWeeksAgo)
        ->count();

    return response()->json(['resolvedCount' => $resolvedCount]);
}


public function getSuccessfulActions()
{
    $successfulActions = DB::table('anecdotal_outcome')
        ->join('actions', 'anecdotal_outcome.actions_id', '=', 'actions.id')
        ->select('actions.action_taken as actions', DB::raw('count(*) as count'))
        ->where('anecdotal_outcome.outcome', '=', 'Successful')
        ->groupBy('actions')
        ->get();

    return response()->json($successfulActions);
}


}

