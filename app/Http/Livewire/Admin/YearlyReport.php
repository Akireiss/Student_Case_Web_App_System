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
    public $ShTotalStudents;
    public $ShTotalEnrollment;
    //total dropout
    public $ShTotalDropOut;
    //promotion
    public $ShTotalPromotion;

    //calculation
    public $ShCompletionPercent;
    public $ShPromotionPercent;
    public $ShDropOutRate;

    //year selection
    public $ShCrYear;
    public $ShPrYear;
    public $ShDrYear;

    //High School
    public $HsTotalEnrollment;


    public $HsTotalPromotion;
    public $HsPromotionPercent;
    public $HsPrYear;


    public $HsTotalDropOut;
    public $HsDropOutRate;
    public $HsDrYear;

    public function mount()
    {
        $currentYear = date('Y');
        $this->ShCrYear = $currentYear . '-' . ($currentYear + 1);
        $this->ShPrYear = $currentYear . '-' . ($currentYear + 1);
        $this->ShDrYear = $currentYear . '-' . ($currentYear + 1);
        $this->yearLevel = $currentYear . '-' . ($currentYear + 1);

        $this->HsDrYear = $currentYear . '-' . ($currentYear + 1);
        $this->HsPrYear = $currentYear . '-' . ($currentYear + 1);
    }


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

        //Senior High
        $completter = $this->ShTotalStudents = Students::whereHas('classroom', function ($query) {
            $query->where('grade_level', 11);
        })->where('status', 0)->count();
        //dropout
        $ShDropout = $this->ShTotalDropOut = Students::whereHas('classroom', function ($query) {
            $query->whereIn('grade_level', [11, 12]);
        })->where('status', 1)->count();
        //promotion
        $ShPromotion = $this->ShTotalPromotion = Students::where(function ($query) {
            // Check for Grade 11 students updated to Grade 12 within the past year
            $query->whereHas('classroom', function ($query) {
                $query->where('grade_level', 11)->where('updated_at', '>=', now()->subYear());
            });
            // Check for Grade 12 students
            $query->orWhereHas('classroom', function ($query) {
                $query->where('grade_level', 12);
            });
        })->count();

        //ShTotalEnrollment
        $enrollment = $this->ShTotalEnrollment = Students::whereHas('classroom', function ($query) {
            $query->whereIn('grade_level', [11, 12]);
        })->where('status', 0)->count();

        // Check if $enrollment is zero before performing division
        //Senior High
        $this->ShCompletionPercent = $enrollment > 0 ? ($completter / $enrollment) * 100 : 0;
        $this->ShPromotionPercent = $enrollment > 0 ? ($ShPromotion / $enrollment) * 100 : 0;
        $this->ShDropOutRate = $enrollment > 0 ? ($ShDropout / $enrollment) * 100 : 0;
        //End Senior High


        //High School
        $HsDropout = $this->HsTotalDropOut = Students::where('department', 0)->where('status', 1)->count();

        // Promotion
        $HsPromotion = $this->HsTotalPromotion = Students::where(function ($query) {
            // Grade 7, 8, 9, 10 students updated to Grade 11 within the past year
            $query->whereHas('classroom', function ($query) {
                $query->whereIn('grade_level', [7, 8, 9, 10])
                    ->where('updated_at', '>=', now()->subYear());
            });

            // Count Grade 11 students
            $query->orWhereHas('classroom', function ($query) {
                $query->where('grade_level', 11);
            });
        })->count();


        //Hs enrollment
        $HsEnrollment = $this->HsTotalEnrollment = Students::whereHas('classroom', function ($query) {
            $query->whereIn('grade_level', [11, 12]);
        })->where('status', 0)->count();

        //Computing
        // $this->ShCompletionPercent = $enrollment > 0 ? ($completter / $enrollment) * 100 : 0;
        $this->HsPromotionPercent = $HsEnrollment > 0 ? ($HsPromotion / $HsEnrollment) * 100 : 0;
        $this->HsDropOutRate = $HsEnrollment > 0 ? ($HsDropout / $HsEnrollment) * 100 : 0;
        //End School

        return view('livewire.admin.yearly-report', [])
            ->extends('layouts.dashboard.index')
            ->section('content');
    }


    public function saveReport()
    {
        $this->validate([
            'yearLevel' => 'required|regex:/^\d{4}-\d{4}$/',
        ]);

        $data = [];

        foreach ($this->groupedClassrooms as $gradeLevel => $classroom) {
            $data[] = [
                'grade_level' => $gradeLevel,
                'male' => $this->selectedOption === 'High School' ? $classroom['total_hs_male'] : $classroom['total_sh_male'],
                'female' => $this->selectedOption === 'High School' ? $classroom['total_hs_female'] : $classroom['total_sh_female'],
                'total' => $classroom['total_students'],
            ];
        }
        Yearly::create([
            'data' => json_encode($data),
            'category' => $this->selectedOption,
            'school_year' => $this->yearLevel,
        ]);

        session()->flash('success', 'Report Successfully Added');
    }

    public function save()
    {
        $this->validate([
            'ShCrYear' => 'required|regex:/^\d{4}-\d{4}$/',
            'ShPrYear' => 'required|regex:/^\d{4}-\d{4}$/',
            'ShDrYear' => 'required|regex:/^\d{4}-\d{4}$/',
        ]);

        $rates = [];

        $completionRate = [
            'Completters' => $this->ShTotalStudents,
            'Enrollment' => $this->ShTotalEnrollment,
            'Percent Cr' => $this->ShCompletionPercent,
        ];
        $rates[] = [
            'type' => 1,
            'rate' => $completionRate,
            'year' => $this->ShCrYear,

        ];


        $promotionRate = [
            'Promotes' => $this->ShTotalPromotion,
            'Enrollment' => $this->ShTotalEnrollment,
            'Percent PR' => $this->ShPromotionPercent,
        ];
        $rates[] = [
            'type' => 2,
            'rate' => $promotionRate,
            'year' => $this->ShPrYear,

        ];


        $ShDropOutRate = [
            'Drop Out' => $this->ShTotalDropOut,
            'Enrollment' => $this->ShTotalEnrollment,
            'Percent Dr' => $this->ShDropOutRate,
        ];
        $rates[] = [
            'type' => 3,
            'rate' => $ShDropOutRate,
            'year' => $this->ShDrYear,

        ];


        foreach ($rates as $rateData) {
            Yearly::create([
                'data' => json_encode($rateData['rate']),
                'category' => $this->selectedOption,
                'school_year' => $rateData['year'],
                // Use the year from rateData
                'type' => $rateData['type'],
            ]);
        }

        session()->flash('message', 'Yearly reports saved successfully.');
    }




    public function saveReportHs()
    {
        $this->validate([
            'HsPrYear' => 'required|regex:/^\d{4}-\d{4}$/',
            'HsDrYear' => 'required|regex:/^\d{4}-\d{4}$/',
        ]);

        $HsRates = [];


        $HsPromotionRate = [
            'Promotes' => $this->HsTotalPromotion,
            'Enrollment' => $this->HsTotalEnrollment,
            'Percent PR' => $this->HsPromotionPercent
        ];
        $HsRates[] = [
            'type' => 2,
            'rate' => $HsPromotionRate,
            'year' => $this->HsPrYear,

        ];


        $HsDropOutRate = [
            'Drop Out' => $this->HsTotalDropOut,
            'Enrollment' => $this->HsTotalEnrollment,
            'Percent Dr' => $this->HsDropOutRate,
        ];
        $HsRates[] = [
            'type' => 3,
            'rate' => $HsDropOutRate,
            'year' => $this->HsDrYear,
            // Include the year for Drop Out Rate
        ];


        foreach ($HsRates as $HsRateData) {
            Yearly::create([
                'data' => json_encode($HsRateData['rate']),
                'category' => $this->selectedOption,
                'school_year' => $HsRateData['year'],
                // Use the year from HsRateData
                'type' => $HsRateData['type'],
            ]);
        }

        session()->flash('message', 'High school reports saved successfully.');
    }
}
