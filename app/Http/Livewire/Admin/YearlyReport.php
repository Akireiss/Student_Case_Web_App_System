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
                    $query->where('gender', 0)->where('status', 2);
                },
                'students as total_sh_female' => function ($query) {
                    $query->where('gender', 1)->where('status', 2);
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
        })->where('status', 2)->count();
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
        })->where('status', 2)->count();

        //Computing all
        $this->completionPercent = ($completter / $enrollment) * 100;
        $this->promotionPercent = ($promotion / $enrollment) * 100;
        $this->dropOutRate = ($dropout / $enrollment) * 100;

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

}
