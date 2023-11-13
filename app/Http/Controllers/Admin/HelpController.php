<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\Activity;
use Barryvdh\DomPDF\Facade\Pdf;
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



        $highSchools = Classroom::where('status', 0)
            ->whereIn('grade_level', [7, 8, 9, 10])->get();

        $seniorHigh = Classroom::where('status', 0)
            ->whereIn('grade_level', [11, 12])
            ->get();

        $grave = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 1);
        });

        $minor = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 0);
        });

        return view('admin.help.index', compact('data', 'highSchools', 'seniorHigh', 'grave', 'minor'));
    }


    public function getOffenseCountsNew(Request $request)
    {
        $year = $request->input('year', 'All');

        $query = DB::table('anecdotal')
            ->join('offenses', 'anecdotal.offense_id', '=', 'offenses.id')
            ->select('offenses.offenses as offense', DB::raw('count(*) as count'))
            ->groupBy('offense');

        if ($year === 'All') {
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



    public function reportGenerate(Request $request)
    {

        // Retrieve data based on the form criteria
        $department = $request->input('department');
        $highSchool = $request->input('highSchool');
        $SeniorHigh = $request->input('SeniorHigh');
        $year = $request->input('year');
        $status = $request->input('status');

        $anecdotals = Anecdotal::query();

        if ($department === 'All') {
            $anecdotals->whereIn('case_status', [0, 1, 2, 3, 4]);
        }

        if ($highSchool === 'All') {
            // Fetch all classrooms with grade levels 7, 8, 9, and 10
            $classrooms = Classroom::whereIn('grade_level', [7, 8, 9, 10])->get();

            $totalMaleCasesForClassroom = [];
            $totalFemaleCasesForClassroom = [];

            foreach ($classrooms as $classroom) {
                $totalMaleCases = $classroom->students()
                    ->where('gender', 0)
                    ->whereHas('anecdotal', function ($query) use ($status) {
                        $query->where('case_status', $status);
                    })
                    ->count();

                $totalFemaleCases = $classroom->students()
                    ->where('gender', 1)
                    ->whereHas('anecdotal', function ($query) use ($status) {
                        $query->where('case_status', $status);
                    })
                    ->count();

                // Use classroom ID as the key in the arrays
                $totalMaleCasesForClassroom[$classroom->id] = $totalMaleCases;
                $totalFemaleCasesForClassroom[$classroom->id] = $totalFemaleCases;
            }

        }

        // Now you have the cases for each grade and can pass them to your PDF view


        if ($SeniorHigh === 'All') {
            $anecdotals->whereHas('students', function ($query) use ($department) {
                $query->where('department', $department);
            });
        }

        if ($year === 'All') {
            // Handle 'All' case by not applying date filtering
        } else {
            // Parse the selected year into a start and end date
            $yearParts = explode('-', $year);
            $startYear = Carbon::create($yearParts[0], 6, 1);
            $endYear = Carbon::create($yearParts[1], 5, 31)->endOfDay();

            // Apply the date filter
            $anecdotals->whereBetween('created_at', [$startYear, $endYear]);
        }


        if ($status === 'All') {
            $anecdotals->where('case_status', $status);
        }

        // Fetch the filtered data
        $anecdotals = $anecdotals->get();

        // Load a view and generate the PDF
        $pdf = PDF::loadView('pdf.test', [
            'anecdotals' => $anecdotals,
            'totalMaleCasesForClassroom' => $totalMaleCasesForClassroom,
            'totalFemaleCasesForClassroom' => $totalFemaleCasesForClassroom,
            'classrooms' => $classrooms
        ]);

        return $pdf->stream('report.pdf');
    }
}
