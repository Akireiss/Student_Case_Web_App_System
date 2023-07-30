<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Anecdotal;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reports.add');
    }

    public function view(Anecdotal $anecdotal) {
        $cases = Anecdotal::where('student_id', $anecdotal->student_id)
                        ->latest('created_at')
                        ->get();
        return view('admin.reports.view', compact('anecdotal', 'cases'));
    }


}
