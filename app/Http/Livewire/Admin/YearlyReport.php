<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Classroom;
use App\Models\YearlyReport as Yearly;

class YearlyReport extends Component
{
    public $yearLevel;
    public $selectedOption = 'High School';
    public $groupedClassrooms = [];


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
            $total = new \stdClass;
            $total->total_hs_male = $group->sum('total_hs_male');
            $total->total_hs_female = $group->sum('total_hs_female');
            $total->total_sh_male = $group->sum('total_sh_male');
            $total->total_sh_female = $group->sum('total_sh_female');
            $total->total_students = $total->total_hs_male + $total->total_hs_female + $total->total_sh_male + $total->total_sh_female;
            return $total;
        });

        // Sort by grade_level
        $this->groupedClassrooms = $groupedClassrooms->sortKeys();

        return view('livewire.admin.yearly-report')
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
