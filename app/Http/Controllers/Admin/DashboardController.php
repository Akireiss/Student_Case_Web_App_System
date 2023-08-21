<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anecdotal;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getDashboardData(Request $request)
    {
        $totalStudents = Students::count();
        $totalCases = Anecdotal::count();
        $pendingCases = Anecdotal::where('case_status', 0)->count();
        $resolvedCases = Anecdotal::where('case_status', 2)->count();

        return response()->json([
            'totalStudents' => $totalStudents,
            'totalCases' => $totalCases,
            'pendingCases' => $pendingCases,
            'resolvedCases' => $resolvedCases,
        ]);
    }

    public function getCaseCounts()
    {
        $caseCounts = Anecdotal::selectRaw("DATE_FORMAT(created_at, '%M') as month, case_status, count(*) as count")
            ->groupBy('month', 'case_status')
            ->get();

        $data = [
            'pending' => [],
            'resolved' => [],
        ];

        foreach ($caseCounts as $count) {
            $month = date('F', strtotime($count->month));

            if ($count->case_status === 0) {
                $data['pending'][$month] = $count->count;
            } else if ($count->case_status === 2) {
                $data['resolved'][$month] = $count->count;
            }
        }

        return response()->json($data);
    }
}

