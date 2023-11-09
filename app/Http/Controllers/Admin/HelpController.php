<?php

namespace App\Http\Controllers\Admin;

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

public function index()
{
    $gradeLevels = ["7", "8", "9", "10", "11", "12"];

    $data = [];

    foreach ($gradeLevels as $gradeLevel) {
        $classrooms = Classroom::where('grade_level', $gradeLevel)->pluck('id');
        $offenses = Anecdotal::whereHas('students', function ($query) use ($classrooms) {
                $query->whereIn('classroom_id', $classrooms);
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

    return view('admin.help.index', compact('data'));
}

public function getOffenseCountsNew()
{
    $offenseCounts = DB::table('anecdotal')
        ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
        ->select('offenses.offenses as offense', DB::raw('count(*) as count'))
        ->groupBy('offense')
        ->get();

    return response()->json($offenseCounts);
}

}
