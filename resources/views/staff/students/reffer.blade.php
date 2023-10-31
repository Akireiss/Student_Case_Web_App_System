@extends('layouts.dashboard.index')
@section('content')

<x-form title="">
    <x-slot name="actions">
        <x-link :href="url('adviser/students')">Back</x-link>
    </x-slot>

    <h6 class="text-sm mt-3 mb-6  font-bold uppercase">
        Referr Students
    </h6>
    <x-slot name="slot">
        @if ($classroom->students)
            <form action="{{ route('studentsClassroom.update', ['classroom' => $classroom]) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($classroom->students as $student)
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="relative mb-1">
                            <x-label>Student Name</x-label>
                            <x-input value="{{ $student->first_name }} {{ $student->last_name }}" disabled />
                        </div>


                        <div class="relative mb-1">
                            <x-label>Total Cases </x-label>
                            <x-input
                value="Pending: {{ $student->anecdotal->where('case_status', 0)->count() }}, Ongoing: {{ $student->anecdotal->where('case_status', 1)->count() }}, Resolved: {{ $student->anecdotal->where('case_status', 2)->count()}}, Follow-Up {{ $student->anecdotal->where('case_status', 3)->count() }}, Reffer: {{ $student->anecdotal->where('case_status', 4)->count() }} " disabled />
                        </div>


                        <div class="relative mb-1">
                            <x-label>Referred to Classroom</x-label>
                            <x-select name="students[{{ $student->id }}][classroom_id]">
                                @foreach ($higherClass as $class)
                                    <option value="{{ $class->id }}"
                                        {{ $class->id == $classroom->id ? 'selected' : '' }}>
                                        Grade: {{ $class->grade_level }} {{ $class->section }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end items-center">
                    @if (session('success'))
                        @foreach (session('success') as $message)
                            <span class="text-green-500 mx-4">
                                {{ $message }}
                            </span>
                        @endforeach
                    @endif

                    <x-button type="submit">Update Students</x-button>
                </div>

            </form>
        @else
            <div>
                <p class="text-center">
                    No Students Found
                </p>
            </div>
        @endif
    </x-slot>


</x-form>

@endsection
