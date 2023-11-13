<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\YearlyReport;
use Illuminate\Http\Request;

class YearlyReportController extends Controller
{
    public function index(YearlyReport $yearlyReport)
    {
        // Decode the JSON data
        $decodedData = json_decode($yearlyReport->data, true);

        return view('admin.settings.yearly-report.index', compact('yearlyReport', 'decodedData'));
    }


}
