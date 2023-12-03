<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Profile;
use App\Models\Anecdotal;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Students;

class PdfController extends Controller
{
    public function generateStudentPdf(Students $student) {
        $pdf = Pdf::loadView('pdf.studentPdf', ['student' => $student]);
        return $pdf->stream();
    }

    public function generatePdf($id)
    {
        $profile = Profile::with('family')->find($id);

        if (!$profile) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.pdf', ['profile' => $profile]);

        // Set the paper size to 'legal' (8.5x14 inches)
        $pdf->setPaper('legal');

        return $pdf->stream();
    }


    public function testPdf($id)
    {

        $profile = Profile::with('family')->find($id);

        if (!$profile) {
            abort(403);
        }
        $pdf = Pdf::loadView('testPdf', ['profile' => $profile]);

        return $pdf->stream();
    }



    public function generateReport()
    {
        $highSchools = Classroom::where('status', 0)
        ->whereIn('grade_level', [7, 8, 9, 10 ])->get();

        $seniorHigh = Classroom::where('status', 0)
        ->whereIn('grade_level', [11, 12])
        ->get();

        $grave = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 1);
        });

        $minor = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 0);
        });

        $minorAndGrave = Anecdotal::count();

        return view('admin.settings.report.index',
        compact('highSchools', 'seniorHigh', 'grave', 'minor',
        'minorAndGrave'));
    }

    public function generateReportPDF(Request $request)
    {
        $department = $request->input('department');

        $highSchool = $request->input('highSchool');

        $SeniorHigh = $request->input('SeniorHigh');

        $category = $request->input('selectedCategory', 'All');

        $year = $request->input('year', 'All');

        $status = $request->input('status', 'All');



        $SeniorId = $request->input('SeniorHigh');

        $highSchoolId = $request->input('highSchool');


        $seniorHighSchools = [];



        // Retrieve a single classroom instance
        $highSchoolIds = Classroom::where('id', $highSchoolId)->first();
        $seniorHighSchool = Classroom::where('id', $SeniorId)->first();

        $anecdotals = Anecdotal::query();

        // if ($classroomId !== 'All') {
        //     $anecdotals->whereHas('students', function ($query) use ($classroomId) {
        //         $query->where('classroom_id', $classroomId);
        //     });
        // }

        if ($department === 'All') {
            $anecdotals->whereIn('case_status', [0, 1, 2, 3, 4]);
        }

        if ($highSchool !== 'All') {
            $HighSchoolClass = Classroom::where('id', $highSchoolIds)->get();
            $anecdotals->whereHas('students', function ($query) use ($highSchoolIds) {
                $query->where('classroom_id', $highSchoolIds);
            });
        } else {
            $HighSchoolClass = Classroom::whereIn('grade_level', [7, 8, 9, 10])->get();
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 0);
            });
        }


        if ($SeniorHigh !== 'All') {
            $seniorHighSchools = Classroom::where('id', $SeniorId)->get();
            $anecdotals->whereHas('students', function ($query) use ($seniorHighSchool) {
                $query->where('classroom_id', $seniorHighSchool);
            });
        } else {
            $seniorHighSchools = Classroom::whereIn('grade_level', [11, 12])->get();
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 1);
            });

        }

        if ($category !== 'All') {
            $anecdotals->whereHas('offenses', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        if ($year !== 'All') {
            // Calculate the start and end dates for the selected year
            $yearParts = explode('-', $year);
            $startYear = Carbon::create($yearParts[0], 6, 1);
            $endYear = Carbon::create($yearParts[1], 5, 31)->endOfDay();

            $anecdotals->whereBetween('created_at', [$startYear, $endYear]);
        }

        if ($status !== 'All') {
            $anecdotals->where('case_status', $status);

        }

        $anecdotals = $anecdotals->get();

        $HighClassroom = Classroom::where('status', 0)->where('id',  $highSchool)->get();
        $SeniorClassroom = Classroom::where('status', 0)->where('id',  $SeniorId)->get();

        $HighSchoolClass = Classroom::whereIn('grade_level', [6, 7, 8, 9 ,10])->get();
      //  $seniorClass = Classroom::whereIn('grade_level', [11, 12])->get();

        // Generate and stream the PDF
        $pdf = PDF::loadView('pdf.report', [
            'seniorHighSchool' => $seniorHighSchool,
            'highSchoolIds' =>  $highSchoolIds,
            'category' => $category,
            'anecdotals' => $anecdotals,
            'status' => $status,
            'year' => $year,
            'department' => $department,
            'highSchool' => $highSchool,
            'SeniorHigh' => $SeniorHigh,
            'seniorHighSchools' => $seniorHighSchools,
            'HighSchoolClass' => $HighSchoolClass,
            //For the model in fethching classroom
            'HighClassroom' =>  $HighClassroom,
            'SeniorClassroom' => $SeniorClassroom
        ]);



        return $pdf->stream('report.pdf');
    }

}
