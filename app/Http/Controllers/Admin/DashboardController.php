<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScheduledNotification;
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
        $currentDate = now()->startOfDay(); // Start of the current day

        $delayedNotif = ScheduledNotification::whereDate('created_at', '<=', $currentDate) // Equal or older notifications
            ->where('read_at', null) //wher
            ->orderBy('created_at', 'desc')
            ->get();

        // Encode the JSON data in each notification before passing it to the view
        $delayedNotif->each(function ($notification) {
            $notification->data = json_decode($notification->data, true);
        });

        //gagamitin pag hindi live
        // $maleCases = Anecdotal::whereHas('students', function ($query) {
        //     $query->where('gender', 0);
        // })->count();

        // $femaleCases = Anecdotal::whereHas('students', function ($query) {
        //     $query->where('gender', 1);
        // })->count();


        return view('admin.dashboard.dashboard', compact('delayedNotif'));
    }

    public function markAsRead(Request $request, ScheduledNotification $notification)
    {
        $notification->update(['read_at' => now()]);

        return response()->json(['message' => 'Notification marked as read']);
    }

    public function getDashboardData(Request $request)
    {
        $totalStudents = Students::where('status', 0)->count();
        $totalMale = Students::where('status', 0)->where('gender', 0)->count();
        $totalFemale = Students::where('status', 0)->where('gender', 1)->count();
        $totalCases = Anecdotal::count();
        $pendingCases = Anecdotal::where('case_status', 0)->count();
        $ongoingCases = Anecdotal::where('case_status', 1)->count();
        $resolvedCases = Anecdotal::where('case_status', 2)->count();

        $maleCases = Anecdotal::whereHas('students', function ($query) {
            $query->where('gender', 0);
        })->count();

        $femaleCases = Anecdotal::whereHas('students', function ($query) {
            $query->where('gender', 1);
        })->count();

        return response()->json([
            'totalStudents' => $totalStudents,
            'totalCases' => $totalCases,
            'pendingCases' => $pendingCases,
            'resolvedCases' => $resolvedCases,
            'ongoingCases' => $ongoingCases,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'maleCases' => $maleCases,
            'femaleCases' => $femaleCases,
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
            'followup' => [],
            'refferal' => [],
        ];

        foreach ($caseCounts as $count) {
            $month = date('F', strtotime($count->month));

            if ($count->case_status === 0) {
                $data['pending'][$month] = $count->count;
            } else if ($count->case_status === 1) {
                $data['ongoing'][$month] = $count->count;
            } else if ($count->case_status === 2) {
                $data['resolved'][$month] = $count->count;
            } else if ($count->case_status === 3) {
                $data['followup'][$month] = $count->count;
            } else if ($count->case_status === 4) {
                $data['refferal'][$month] = $count->count;
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
            ->select(DB::raw('count(*) as count, action as label'))
            ->where('outcome', '=', 2)
            ->groupBy('action') // Group by 'action' instead of 'outcome'
            ->get();

        return response()->json($successfulActions);
    }


    public function getOngoingCases()
    {
        $oneWeekAgo = Carbon::now()->subWeeks(1);

        $ongoingCases = DB::table('anecdotal')
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->select('anecdotal.*', 'students.first_name', 'students.middle_name', 'students.last_name', 'students.lrn', 'students.status')
            ->where('anecdotal.case_status', 1)
            ->where('anecdotal.updated_at', '>', $oneWeekAgo)
            ->get();

        $resolvedCases = DB::table('anecdotal')
            ->join('students', 'anecdotal.student_id', '=', 'students.id')
            ->select('anecdotal.*', 'students.first_name', 'students.middle_name', 'students.last_name', 'students.lrn', 'students.status')
            ->where('anecdotal.case_status', 2)
            ->where('anecdotal.updated_at', '>', $oneWeekAgo)
            ->orderBy('anecdotal.updated_at', 'desc')
            ->get();

        return response()->json(['ongoingCases' => $ongoingCases, 'resolvedCases' => $resolvedCases]);
    }



}

