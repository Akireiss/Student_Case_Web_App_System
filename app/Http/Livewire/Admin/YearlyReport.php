<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Classroom;

class YearlyReport extends Component
{
    public $selectedOption = 'High School';

    public function render()
    {
        $gradeLevel = $this->selectedOption === 'Senior High' ? [11, 12] : [7, 8, 9, 10];

        $classrooms = Classroom::whereIn('grade_level', $gradeLevel)
            ->where('status', 0)
            ->withCount([
                'students as total_students',
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
            return $group->reduce(function ($carry, $classroom) {
                $carry->total_students += $classroom->total_students;
                $carry->total_hs_male += $classroom->total_hs_male;
                $carry->total_hs_female += $classroom->total_hs_female;
                $carry->total_sh_male += $classroom->total_sh_male;
                $carry->total_sh_female += $classroom->total_sh_female;
                return $carry;
            }, $group[0]);
        });
        $groupedClassrooms = $groupedClassrooms->sortBy('grade_level');
        return view('livewire.admin.yearly-report', compact('groupedClassrooms'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

}
