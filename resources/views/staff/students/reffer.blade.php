@extends('layouts.dashboard.index')
@section('content')

    <x-form title="">
        <x-slot name="actions">

        </x-slot>
        <!-- ... rest of your form ... -->



        <h6 class="text-sm mt-3 mb-6  font-bold uppercase">
            Referr Students
        </h6>

        <x-slot name="slot">
            @if ($students)
                @foreach ($students as $student)
                <form action="{{ route('students.update', ['student' => $student->id]) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 lg:grid-cols-2 gap-4">
                            <div class="relative mb-3">
                                <x-label>Student Name</x-label>
                                <x-input value="{{ $student->first_name }} {{ $student->last_name }}" disabled />
                            </div>
                            <div class="relative mb-3">
                                <x-label>Referred to Classroom</x-label>
                                <x-select name="students[]">
                                    @foreach ($classroom as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $class->id == $classroomId ? 'selected' : '' }}>
                                            Grade: {{ $class->grade_level }} {{ $class->section }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>

                        </div>
                @endforeach
            @endif
            <div class="flex justify-end items-center">
                @if (session('message'))
                    <span class="text-green-500 mx-4">
                        {{ session('message') }}
                    </span>
                @endif

                <x-button type="submit">Update Students</x-button>
            </div>
            </form>


        </x-slot>

    </x-form>

@endsection
