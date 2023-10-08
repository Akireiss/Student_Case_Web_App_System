<?php

namespace App\Http\Livewire\Admin;

use App\Models\Students;
use stdClass;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\YearlyReport as Yearly;

class YearlyReport extends Component
{
    public $yearLevel;
    public $selectedOption = 'High School';
    public $groupedClassrooms = [];
    public $totalStudents;
    public $totalEnrollment;
    //total dropout
    public $totalDropOut;
    //promotion
    public $totalPromotion;

    //calculation
    public $completionPercent;
    public $promotionPercent;
    public $dropOutRate;

    //year selection
    public $CrYear;
    public $PrYear;
    public $DrYear;


    public function render()
    {
        $gradeLevel = $this->selectedOption === 'Senior High' ? [11, 12] : [7, 8, 9, 10];

        $classrooms = Classroom::whereIn('grade_level', $gradeLevel)
            ->where('status', 0)
            ->withCount([
                'students as total_hs_male' => function ($query) {
                    $query->where('gender', 0)->where('status', 0);
                },
                'students as total_hs_female' => function ($query) {
                    $query->where('gender', 1)->where('status', 0);
                },
                'students as total_sh_male' => function ($query) {
                    $query->where('gender', 0)->where('status', 0);
                },
                'students as total_sh_female' => function ($query) {
                    $query->where('gender', 1)->where('status', 0);
                },
            ])->get();

        $groupedClassrooms = $classrooms->groupBy('grade_level')->map(function ($group) {
            $total = new stdClass;
            $total->total_hs_male = $group->sum('total_hs_male');
            $total->total_hs_female = $group->sum('total_hs_female');
            $total->total_sh_male = $group->sum('total_sh_male');
            $total->total_sh_female = $group->sum('total_sh_female');
            $total->total_students = $total->total_hs_male + $total->total_hs_female + $total->total_sh_male + $total->total_sh_female;
            return $total;
        });

        $this->groupedClassrooms = $groupedClassrooms->sortKeys();
        $completter = $this->totalStudents = Students::whereHas('classroom', function ($query) {
            $query->where('grade_level', 11);
        })->where('status', 0)->count();
        //dropout
        $dropout = $this->totalDropOut = Students::whereHas('classroom', function ($query) {
            $query->whereIn('grade_level', [11, 12]);
        })->where('status', 1)->count();
        //promotion
        $promotion = $this->totalPromotion = Students::where(function ($query) {
            // Check for Grade 11 students updated to Grade 12 within the past year
            $query->whereHas('classroom', function ($query) {
                $query->where('grade_level', 11)->where('updated_at', '>=', now()->subYear());
            });

            // Check for Grade 12 students
            $query->orWhereHas('classroom', function ($query) {
                $query->where('grade_level', 12);
            });
        })->count();

        //totalEnrollment
        $enrollment = $this->totalEnrollment = Students::whereHas('classroom', function ($query) {
            $query->whereIn('grade_level', [11, 12]);
        })->where('status', 0)->count();

        // Check if $enrollment is zero before performing division
        //Senior High
        $this->completionPercent = $enrollment > 0 ? ($completter / $enrollment) * 100 : 0;
        $this->promotionPercent = $enrollment > 0 ? ($promotion / $enrollment) * 100 : 0;
        $this->dropOutRate = $enrollment > 0 ? ($dropout / $enrollment) * 100 : 0;

        //End Senior High

        //High School

        //End School

        return view('livewire.admin.yearly-report', [
        ])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }


    public function saveReport()
{
    // Initialize an empty array to store aggregated data
    $data = [];

    foreach ($this->groupedClassrooms as $gradeLevel => $classroom) {
        // Add data from each classroom to the $data array
        $data[] = [
            'grade_level' => $gradeLevel,
            'male' => $this->selectedOption === 'High School' ? $classroom['total_hs_male'] : $classroom['total_sh_male'],
            'female' => $this->selectedOption === 'High School' ? $classroom['total_hs_female'] : $classroom['total_sh_female'],
            'total' => $classroom['total_students'],
        ];
    }

    // Save the aggregated data as a single record
    Yearly::create([
        'data' => json_encode($data),
        'category' => $this->selectedOption,
        'school_year' => $this->yearLevel,
    ]);

    session()->flash('message', 'Report Successfully Added');
}

public function save()
{
    $rates = [];

    // Define the Completion Rate with its associated year
    $completionRate = [
        'Completters' => $this->totalStudents,
        'Enrollment' => $this->totalEnrollment,
        'Percent Cr' => $this->completionPercent,
    ];
    $rates[] = [
        'type' => 0,
        'rate' => $completionRate,
        'year' => $this->CrYear, // Include the year for Completion Rate
    ];

    // Define the Promotion Rate with its associated year
    $promotionRate = [
        'Promotes' => $this->totalPromotion,
        'Enrollment' => $this->totalEnrollment,
        'Percent PR' => $this->promotionPercent,
    ];
    $rates[] = [
        'type' => 1,
        'rate' => $promotionRate,
        'year' => $this->PrYear, // Include the year for Promotion Rate
    ];

    // Define the Drop Out Rate with its associated year
    $dropOutRate = [
        'Drop Out' => $this->totalDropOut,
        'Enrollment' => $this->totalEnrollment,
        'Percent Dr' => $this->dropOutRate,
    ];
    $rates[] = [
        'type' => 2,
        'rate' => $dropOutRate,
        'year' => $this->DrYear, // Include the year for Drop Out Rate
    ];

    // Save each rate type as a separate Yearly instance
   // Save each rate type as a separate Yearly instance
foreach ($rates as $rateData) {
    Yearly::create([
        'data' => json_encode($rateData['rate']),
        'category' => $this->selectedOption,
        'school_year' => $rateData['year'], // Use the year from rateData
        'type' => $rateData['type'],
    ]);
}

    session()->flash('message', 'Yearly reports saved successfully.');
}


}
