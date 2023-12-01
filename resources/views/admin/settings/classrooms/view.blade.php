@extends('layouts.dashboard.index')
@section('content')
    {{-- Form --}}
    <x-form title="">
        <x-slot name="actions">
            {{-- Button --}}
            <x-link href="{{ url('admin/settings/classrooms') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">

            <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Classroom Details
            </h6>
            <!-- Personal information form fields -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        {{-- Label --}}
                        <x-label>Grade Level</x-label>
                        <x-input value="Grade: {{ $classroom->grade_level }} {{ $classroom->section }}" disabled />
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Adviser</x-label>
                        <x-input value="{{ $classroom->employee->employees }}" disabled/>
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Adviser</x-label>
                        <x-input value="{{ $classroom->employee->employees }}" disabled/>
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label>Total Cases</x-label>
                        <x-input value="{{ $classroom->countStudentsAnecdotal() }}" disabled/>
                    </div>
                </div>
            </div>

        </x-slot>
    </x-form>


    @if ($classroom->students)
    @forelse ($classroom->students as $student)
    <x-form title="">
        <x-slot name="actions">

        </x-slot>

        <x-slot name="slot">
            <form>
                @csrf
                @method('PUT')

                <h6 class="text-sm mt-3 mb-6  font-bold uppercase">
                    Students and students cases
                </h6>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="relative mb-3">
                                <x-label>Student Name</x-label>
                                <x-input value="{{ $student->first_name }} {{ $student->last_name }}" disabled />
                            </div>


                            <div class="relative mb-1">
                                <x-label>Total Cases </x-label>
                                <x-input
                    value="Pending: {{ $student->anecdotal->where('case_status', 0)->count() }}, Ongoing: {{ $student->anecdotal->where('case_status', 1)->count() }}, Resolved: {{ $student->anecdotal->where('case_status', 2)->count()}}, Follow-Up {{ $student->anecdotal->where('case_status', 3)->count() }}, Reffer: {{ $student->anecdotal->where('case_status', 4)->count() }} " disabled />
                            </div>
                        </div>





            </form>


        </x-slot>

    </x-form>


    @empty
    <div class="flex justify-center mx-auto mt-12 ">
        <p>No student found for this classroom</p>
    </div>
    @endforelse

    @endif


@endsection
