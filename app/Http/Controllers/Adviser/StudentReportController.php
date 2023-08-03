<?php

namespace App\Http\Controllers\Adviser;

use App\Models\Students;
use App\Models\Anecdotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AnecdotalRequest;

class StudentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff.reports.index');
    }

}
