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
        session()->flash('message', 'Report Successfully Added');

    }

    public function save() {
   // Determine the type based on the selected option
   $type = 0; // Default to Completion Rate
   if ($this->selectedOption === 'Promotion Rate') {
       $type = 1;
   } elseif ($this->selectedOption === 'Drop Out Rate') {
       $type = 2;
   }
   //! need more revisionss
   // Create an array for the selected rate
   $rate = [
       'Completters' => $this->totalStudents,
       'Enrollment' => $this->totalEnrollment,
       'Percent Cr' => $this->completionPercent,
   ];

   // Determine the column name based on the type
   $columnName = 'completion_rate';
   if ($type === 1) {
       $rate = [
           'Promotes' => $this->totalPromotion,
           'Enrollment' => $this->totalEnrollment,
           'Percent PR' => $this->promotionPercent,
       ];
       $columnName = 'promotion_rate';
   } elseif ($type === 2) {
       $rate = [
           'Drop Out' => $this->totalDropOut,
           'Enrollment' => $this->totalEnrollment,
           'Percent Dr' => $this->dropOutRate,
       ];
       $columnName = 'drop_out_rate';
   }

   // Create a new Yearly instance and save it
   $yearly = new Yearly([
       'data' => json_encode($rate),
       'category' => $this->selectedOption,
       'school_year' => $this->yearLevel,
       'type' => $type,
   ]);

   $yearly->save();

   session()->flash('message', 'Yearly report saved successfully.');
}

}
