<?php

namespace App\Http\Controllers\Admin;

use App\Models\Profile;
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

}
