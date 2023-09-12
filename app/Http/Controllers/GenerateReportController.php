<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateReportController extends Controller
{
    public function index() {
        return view('admin.settings.generate-report.index');
    }
}
