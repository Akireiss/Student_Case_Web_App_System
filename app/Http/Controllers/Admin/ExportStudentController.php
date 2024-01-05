<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Exports\StudentsExportExcel;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportStudentController extends Controller
{
    public function index() {
        return view('export.index');
    }

    public function store(Request $request)
{
    try {
        // Validate CSV file upload
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Import students from CSV
        Excel::import(new StudentsImport, $request->file('csv_file'));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Students imported successfully');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Log the validation exception
        Log::error('Validation error during import: ' . $e->getMessage());

        // Get the validation errors and redirect back with error message
        return redirect()->back()->withErrors($e->errors())->with('error', 'Validation error occurred during the import process.');
    } catch (\Exception $e) {
        // Log other exceptions
        Log::error('Error during import: ' . $e->getMessage());

        // Redirect back with a general error message
        return redirect()->back()->with('error', 'An error occurred during the import process.');
    }
}
public function export(Request $request)
    {
        try {
            // Export students to CSV
            return Excel::download(new StudentsExport, 'students.csv');
        } catch (\Exception $e) {
            // Log other exceptions
            Log::error('Error during export: ' . $e->getMessage());

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred during the export process.');
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            // Export students to Excel
            return Excel::download(new StudentsExportExcel, 'students.xlsx');
        } catch (\Exception $e) {
            // Log other exceptions
            Log::error('Error during export: ' . $e->getMessage());

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred during the export process.');
        }
    }
}
