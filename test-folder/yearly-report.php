
public function render()
    {
        $gradeLevel = $this->selectedOption === 'Senior High' ? [11, 12] : [7, 8, 9, 10];

        $classrooms = Classroom::whereIn('grade_level', $gradeLevel)
            ->where('status', 0)
            ->orderBy('grade_level', 'asc')
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

        return view('livewire.admin.yearly-report', compact('classrooms'))
            ->extends('layouts.dashboard.index')
            ->section('content');
    }

    blade



<x-grid columns="3" gap="4" px="0" mt="0">

@foreach ($classrooms as $classroom)
<div class="w-full">
            <h6 class="text-sm mt-3 mb-2 px-4 font-bold uppercase">
                Grade: {{ $classroom->grade_level }}
            </h6>


                <div class="w-full px-4 hidden">
                    <div class="relative mb-3">
                        {{-- Label --}}
                        <x-label>Grade Level</x-label>
                        <x-input disabled value="{{ $classroom->grade_level }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Male</x-label>
                        <x-input disabled value="{{ $selectedOption === 'High School' ?
                        $classroom->total_hs_male : $classroom->total_sh_male }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Female</x-label>
                        <x-input disabled value="{{ $selectedOption === 'High School' ?
                        $classroom->total_hs_female : $classroom->total_sh_female }}" />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Total</x-label>
                        <x-input disabled value="{{ $selectedOption === 'High School' ?
                         $classroom->totalHighSchool()
                         : $classroom->totalSeniorHigh() }}" />
                    </div>
                </div>


</div>

@endforeach
</x-grid>
