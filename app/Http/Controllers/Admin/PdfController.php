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

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        $profile = Profile::with('family')->find($id);

        if (!$profile) {
            abort(403);
        }

        $pdf = Pdf::loadView('pdf.pdf', ['profile' => $profile]);

        return $pdf->download();
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
        $classrooms = Classroom::where('status', 0)->get();

        $grave = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 1);
        });

        $minor = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 0);
        });

        $minorAndGrave = Anecdotal::count();

        return view('admin.settings.report.index', compact('classrooms', 'grave', 'minor', 'minorAndGrave'));
    }

    public function generateReportPDF(Request $request)
    {
        $request->validate([
            'selectedClassroom' => 'required',
            'selectedCategory' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        // Retrieve selected classroom, offense category, and year from the form
        $classroomId = $request->input('selectedClassroom', 'All');
        $category = $request->input('selectedCategory', 'All');
        $year = $request->input('year', 'All');

        $status = $request->input('status', 'All');

        // Retrieve a single classroom instance

        $classroom = Classroom::where('id', $classroomId)->first();
        // Build the query based on the selected options
        $anecdotals = Anecdotal::query();

        if ($classroomId !== 'All') {
            $anecdotals->whereHas('students', function ($query) use ($classroomId) {
                $query->where('classroom_id', $classroomId);
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

        // if ($status !== 'All') {
        //     $anecdotals->whereHas('offenses', function ($query) use ($status) {
        //         $query->where('status', 0);
        //     })->where('case_status', $status);

        // }


        // Get the data based on the query
        $anecdotals = $anecdotals->get();

        // Generate and stream the PDF
        $pdf = PDF::loadView('pdf.report', [
            'anecdotals' => $anecdotals,
            'classroom' => $classroom,
            'status' => $status
        ]);

        return $pdf->stream('report.pdf');
    }
}
