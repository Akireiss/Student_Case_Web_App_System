<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Anecdotal;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    // public function index()
    // {
    //     return view('admin.help.index');
    // }


public function show(Activity $activity)
{
    $activityData = json_decode($activity->properties, true);
    $formattedOld = $this->formatProperties($activityData['old'] ?? []);
    $formattedNew = $this->formatProperties($activityData['attributes'] ?? []);

    return view('admin.settings.audit-trail.view', compact('activity', 'formattedOld', 'formattedNew'));
}

private function formatProperties($properties)
{
    return collect($properties)
        ->map(function ($value, $key) {
            return Str::ucfirst($key) . ': ' . $value;
        })
        ->implode(', ');
}

// private function getStatusLabel($case_status)
// {
//     switch ($case_status) {
//         case 0:
//             return 'pending';
//         case 1:
//             return 'ongoing';
//         case 2:
//             return 'resolved';
//         case 3:
//             return 'followup';
//         case 4:
//             return 'referral';
//         default:
//             return 'unknown';
//     }
// }
// public function getChartData()
// {
//     $caseCounts = Anecdotal::select("classrooms.grade_level", "case_status", DB::raw("COUNT(*) as count"))
//         ->join('students', 'anecdotal.student_id', '=', 'students.id')
//         ->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
//         ->groupBy('classrooms.grade_level', 'case_status')
//         ->get();

//     $data = [
//         'pending' => [],
//         'ongoing' => [],
//         'resolved' => [],
//         'followup' => [],
//         'refferal' => [],
//     ];

//     foreach ($caseCounts as $count) {
//         $grade_level = $count->grade_level;
//         $case_status = $count->case_status;

//         // Assign the count to the appropriate category
//         $category = $this->getStatusLabel($case_status);

//         // Make sure the category is valid
//         if (array_key_exists($category, $data)) {
//             if (!isset($data[$category][$grade_level])) {
//                 $data[$category][$grade_level] = 0;
//             }
//             $data[$category][$grade_level] += $count->count;
//         }
//     }

//     return response()->json($data);
// }
public function getBarChartData(Request $request)
{
    $selectedYear = $request->input('year');
    $gradeLevels = ["7", "8", "9", "10", "11", "12"];
    $data = [];

    if ($selectedYear === 'All') {
        // Handle the "All" option here
        // You may want to adjust this logic depending on your specific requirements
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




public function index(Request $request)
{
    $selectedYear = $request->input('selectedYear');
    $gradeLevels = ["7", "8", "9", "10", "11", "12"];
    $data = [];

    foreach ($gradeLevels as $gradeLevel) {
        $offenses = Anecdotal::where('grade_level', 'LIKE', $gradeLevel . '%')
            ->whereBetween('created_at', [$selectedYear . '-06-01', ($selectedYear + 1) . '-05-31']) // Corrected date range
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


    return view('admin.help.index', compact('data'));
}


public function getOffenseCountsNew(Request $request)
{
    $year = $request->input('year', 'All');

    $query = DB::table('anecdotal')
        ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
        ->select('offenses.offenses as offense', DB::raw('count(*) as count'))
        ->groupBy('offense');

    if ($year !== 'All') {
        // Calculate the start and end dates for the selected year
        $yearParts = explode('-', $year);
        $startDate = Carbon::create($yearParts[0], 6, 1);
        $endDate = Carbon::create($yearParts[1], 5, 31);

        // Assuming you have a date field named 'created_at'
        $query->whereBetween('anecdotal.created_at', [$startDate, $endDate]);
    }

    $offenseCounts = $query->get();

    return response()->json($offenseCounts);
}


}
