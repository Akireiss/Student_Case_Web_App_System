<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Students;
use App\Models\Anecdotal;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\AnecdotalOutcome;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ScheduledNotification;
use Illuminate\Support\Facades\Response;

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

        // $gradeLevels = ["7", "8", "9", "10", "11", "12"];

        // $data = [];

        // foreach ($gradeLevels as $gradeLevel) {
        //     $classrooms = Classroom::where('grade_level', $gradeLevel)->pluck('id');
        //     $offenses = Anecdotal::whereHas('students', function ($query) use ($classrooms) {
        //         $query->whereIn('classroom_id', $classrooms);
        //     })
        //         ->select('case_status', DB::raw('COUNT(*) as count'))
        //         ->groupBy('case_status')
        //         ->pluck('count', 'case_status')
        //         ->toArray();

        //     $data[] = [
        //         'grade_level' => $gradeLevel,
        //         'pending' => $offenses[0] ?? 0,
        //         'ongoing' => $offenses[1] ?? 0,
        //         'resolved' => $offenses[2] ?? 0,
        //         'follow_up' => $offenses[3] ?? 0,
        //         'referral' => $offenses[4] ?? 0,
        //     ];
        // }

        //

        $classrooms = Classroom::where('status', 0)->get();

        return view('admin.dashboard.dashboard', compact('delayedNotif', 'classrooms'));
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

        $pendingCases = Anecdotal::where('case_status', 0)->count();
        $ongoingCases = Anecdotal::where('case_status', 1)->count();
        $resolvedCases = Anecdotal::where('case_status', 2)->count();

        $totalCases =  Anecdotal::whereHas('students', function ($query) {
            $query->where('gender', [0, 1])->where('status', 0);
        })->count();

        $maleCases = Anecdotal::whereHas('students', function ($query) {
            $query->where('gender', 0)->where('status', 0);
        })->count();

        $femaleCases = Anecdotal::whereHas('students', function ($query) {
            $query->where('gender', 1)->where('status', 0);
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

    public function getCaseCounts(Request $request)
    {
        $selectedYear = $request->input('case_year');

        $caseCounts = Anecdotal::selectRaw("DATE_FORMAT(created_at, '%M') as month, case_status, count(*) as count")
            ->when($selectedYear !== 'All', function ($query) use ($selectedYear) {
                // Filter data by selected academic year
                $years = explode('-', $selectedYear);
                $startYear = $years[0];
                $endYear = $years[1];
                $academicYearStart = '06-01';
                $academicYearEnd = '05-31';
                $query->where(function ($q) use ($startYear, $endYear, $academicYearStart, $academicYearEnd) {
                    $q->whereRaw("YEAR(created_at) = $startYear AND created_at >= '$startYear-$academicYearStart'")
                        ->orWhereRaw("YEAR(created_at) = $endYear AND created_at <= '$endYear-$academicYearEnd'");
                });
            })
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
            } elseif ($count->case_status === 1) {
                $data['ongoing'][$month] = $count->count;
            } elseif ($count->case_status === 2) {
                $data['resolved'][$month] = $count->count;
            } elseif ($count->case_status === 3) {
                $data['followup'][$month] = $count->count;
            } elseif ($count->case_status === 4) {
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
    // public function getSuccessfulActions(Request $request)
    // {
    //     $year = $request->input('year', 'All');

    //     $query = DB::table('anecdotal_outcome')
    //         ->select(DB::raw('count(*) as count, action as label'))
    //         ->where('outcome', '=', 2)
    //         ->groupBy('action');

    //     if ($year !== 'All') {
    //         // Calculate the start and end dates for the selected school year
    //         $yearParts = explode('-', $year);
    //         $startMonth = 6; // June
    //         $endMonth = 5;   // May

    //         $startDate = Carbon::create($yearParts[0], $startMonth, 1);
    //         $endDate = Carbon::create($yearParts[1], $endMonth, 31);

    //         // Assuming you have a date field named 'created_at'
    //         $query->whereBetween('created_at', [$startDate, $endDate]);
    //     }

    //     $successfulActions = $query->get();

    //     return response()->json($successfulActions);
    // }


    // public function getSuccessfulActions()
    // {
    //     $successfulActions = DB::table('anecdotal_outcome')
    //         ->select(DB::raw('count(*) as count, action as label'))
    //         ->where('outcome', '=', 2)
    //         ->groupBy('action') // Group by 'action' instead of 'outcome'
    //         ->get();

    //     return response()->json($successfulActions);
    // }


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




    // Grade Level Bar Chart

    public function getBarChartData(Request $request)
    {
        $selectedYear = $request->input('level_offense_year');
        $gradeLevels = ["7", "8", "9", "10", "11", "12"];
        $data = [];

        if ($selectedYear === 'All') {
            foreach ($gradeLevels as $gradeLevel) {
                $offenses = Anecdotal::where('grade_level', 'LIKE', $gradeLevel . '%')
                    ->select('case_status', DB::raw('COUNT(*) as count'))
                    ->groupBy('case_status')
                    ->pluck('count', 'case_status')
                    ->toArray();

                $data[] = [
                    'grade_level' => $gradeLevel,
                    'pending' => $offenses[0] ?? 0,
                    'ongoing' => $offenses[1] ?? 0,
                    'resolved' => $offenses[2] ?? 0,
                    'follow_up' => $offenses[3] ?? 0,
                    'referral' => $offenses[4] ?? 0,
                ];
            }
        } else {
            // Validate the selected year (you may want to add more checks)
            if (!preg_match('/^\d{4}-\d{4}$/', $selectedYear)) {
                return response()->json(['error' => 'Invalid year format.']);
            }

            list($startYear, $endYear) = explode('-', $selectedYear);

            $academicYearStart = '06-01'; // June 1st
            $academicYearEnd = '05-31';   // May 31st

            foreach ($gradeLevels as $gradeLevel) {
                $offenses = Anecdotal::where('grade_level', 'LIKE', $gradeLevel . '%')
                    ->where(function ($query) use ($startYear, $endYear, $academicYearStart, $academicYearEnd) {
                        $query->whereRaw("YEAR(created_at) = $startYear AND created_at >= '$startYear-$academicYearStart'")
                            ->orWhereRaw("YEAR(created_at) = $endYear AND created_at <= '$endYear-$academicYearEnd'");
                    })
                    ->select('case_status', DB::raw('COUNT(*) as count'))
                    ->groupBy('case_status')
                    ->pluck('count', 'case_status')
                    ->toArray();

                $data[] = [
                    'grade_level' => $gradeLevel,
                    'pending' => $offenses[0] ?? 0,
                    'ongoing' => $offenses[1] ?? 0,
                    'resolved' => $offenses[2] ?? 0,
                    'follow_up' => $offenses[3] ?? 0,
                    'referral' => $offenses[4] ?? 0,
                ];
            }
        }

        return response()->json($data);
    }
    //Additional Function

    public function getClassroomData(Request $request)
    {
        $selectedYear = $request->input('level_offense_year');
        list($startYear, $endYear) = explode('-', $selectedYear);

        $academicYearStart = '06-01'; // June 1st
        $academicYearEnd = '05-31';   // May 31st

        $classroomData = Anecdotal::where(function ($query) use ($startYear, $endYear, $academicYearStart, $academicYearEnd) {
            $query->whereRaw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d')) = $startYear AND created_at >= '$startYear-$academicYearStart'")
                ->orWhereRaw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d')) = $endYear AND created_at <= '$endYear-$academicYearEnd'");
        })
            ->distinct('grade_level')
            ->pluck('grade_level');

        return response()->json(['classrooms' => $classroomData]);
    }
    public function getAnecdotalData(Request $request)
    {
        $selectedYear = $request->input('level_offense_year');
        $selectedGradeLevel = $request->input('selected_grade_level');

        list($startYear, $endYear) = explode('-', $selectedYear);

        $academicYearStart = '06-01'; // June 1st
        $academicYearEnd = '05-31';   // May 31st

        $anecdotalData = Anecdotal::where(function ($query) use ($startYear, $endYear, $academicYearStart, $academicYearEnd, $selectedGradeLevel) {
            $query->whereRaw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d')) = $startYear AND created_at >= '$startYear-$academicYearStart'")
                ->orWhereRaw("YEAR(DATE_FORMAT(created_at, '%Y-%m-%d')) = $endYear AND created_at <= '$endYear-$academicYearEnd'")
                ->when($selectedGradeLevel, function ($query, $selectedGradeLevel) {
                    return $query->where('grade_level', $selectedGradeLevel);
                });
        })
            ->where('grade_level', $selectedGradeLevel) // Add this line to filter by classroom
            ->groupBy('case_status')
            ->selectRaw('count(*) as total, case_status')
            ->pluck('total', 'case_status');

        return response()->json(['anecdotalData' => $anecdotalData]);
    }




    //Succcesfull Actions

    public function successfullAction(Request $request)
    {
        $year = $request->input('number_actions_year', 'All');

        $query = DB::table('anecdotal_outcome')
            ->select(DB::raw('count(*) as count, action as label'))
            ->where('outcome', '=', 2)
            ->groupBy('action');

        if ($year !== 'All') {
            // Calculate the start and end dates for the selected school year
            $yearParts = explode('-', $year);
            $startMonth = 6; // June
            $endMonth = 5;   // May

            $startDate = Carbon::create($yearParts[0], $startMonth, 1);
            $endDate = Carbon::create($yearParts[1], $endMonth, 31);

            // Assuming you have a date field named 'created_at'
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $successfulActions = $query->get();

        return response()->json($successfulActions);
    }

    public function notification()
    {
        $user = Auth::user();
        $currentTime = now();

        // Paginate the notifications with a limit of 5 per page
        $notifications = $user->unreadNotifications()
            ->where('created_at', '<=', $currentTime)
            ->paginate(5);

        // Additional information about the total notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'total' => $totalNotifications,
        ]);
    }



    public function read(Request $request, $notificationId)
    {
        $user = Auth::user();

        // Find the notification by ID
        $notification = $user->notifications()->find($notificationId);

        // Check if the notification is found
        if ($notification) {
            // Mark the notification as read
            $notification->markAsRead();

            // Get the updated list of unread notifications
            $unreadNotifications = $user->unreadNotifications;

            // Return the updated list as JSON
            return Response::json(['notifications' => $unreadNotifications]);
        } else {
            // Return an error response if the notification is not found
            return Response::json(['error' => 'Notification not found'], 404);
        }
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json(['message' => 'All notifications marked as read']);
    }

    public function fetchTotalNotifications()
    {
        $user = Auth::user();
        $totalNotifications = $user->unreadNotifications()->count();

        return response()->json(['total' => $totalNotifications]);
    }
}
