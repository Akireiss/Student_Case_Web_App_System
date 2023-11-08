<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Offenses;
use App\Models\Anecdotal;
use App\Models\Classroom;
use Livewire\WithFileUploads;

class PDFReport extends Component
{
    public $selectedClassroom = 'All';
    public $pdfData;
    use WithFileUploads;

    public $selectedCategory = 'All';

    public function render()
    {
        $classrooms = Classroom::where('status', 0)->get();

        $grave = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 1);
        })->count();

        $minor = Anecdotal::whereHas('offenses', function ($query) {
            $query->where('category', 0);
        })->count();

        $minorAndGrave = Anecdotal::count();

        // $anecdotals = Anecdotal::all();
        // $groupedAnecdotals = $anecdotals->groupBy('academic_year');

        return view('livewire.p-d-f-report', compact('classrooms', 'grave', 'minor', 'minorAndGrave'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    public function downloadPDF()
    {
        $classroomId = $this->selectedClassroom;
        $category = $this->selectedCategory;

        // Fetch data based on selected options
        $anecdotals = Anecdotal::query();

        if ($classroomId !== 'All') {
            $anecdotals->where('classroom_id', $classroomId);
        }

        if ($category !== 'All') {
            $anecdotals->whereHas('offenses', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        $anecdotals = $anecdotals->get();

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.report', ['anecdotals' => $anecdotals]);
        $this->pdfData = $pdf->output();

        return response()->stream(
            function () {
                echo $this->pdfData;
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="report.pdf"',
            ]
        );
    }



}
