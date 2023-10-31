@extends('layouts.dashboard.index')
@section('content')

    <div>
        <x-form title="">
            <x-slot name="actions">
                <x-link href="{{ url('admin/settings/classrooms') }}">
                    Back
                </x-link>
            </x-slot>

            <x-slot name="slot">
                <form action="{{ route('classrooms.update', ['classroom' => $classroom]) }}" method="POST">
                    @csrf
                    @method('put')

                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Update Classroom
                    </h6>

                    <!-- Personal information form fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Classroom</x-label>
                                <x-select name="classroom" required>
                                    @foreach ($classrooms as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $class->id == $classroom->id ? 'selected' : '' }}>
                                            Grade: {{ $class->grade_level }} {{ $class->section }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-error fieldName="classroom" />
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Adviser</x-label>
                                <x-select name="employee_id" required>
                                    @foreach ($employees as $emp)
                                        <option value="{{ $emp->id }}"
                                            {{ $emp->id == $classroom->employee_id ? 'selected' : '' }}>
                                            {{ $emp->employees }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-error fieldName="employee_id" />
                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label>Status</x-label>
                                <x-select name="status" required>
                                    <option value="0" {{ $classroom->status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ $classroom->status == 1 ? 'selected' : '' }}>Inactive</option>
                                </x-select>
                                <x-error fieldName="status" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center">
                        <x-alert />
                        <x-button type="submit">Update Classroom</x-button>
                    </div>
                </form>
            </x-slot>


        </x-form>



        <x-form title="">
            <x-slot name="actions">

            </x-slot>

            <x-slot name="slot">
                <form action="{{ route('classrooms.students.update', ['classroom' => $classroom]) }}" method="POST">
                    @csrf
                    @method('put')

                    <h6 class="text-sm mt-3 mb-6  font-bold uppercase">
                        Referr Students
                    </h6>
                    @if ($classroom->students)
                        @foreach ($classroom->students as $student)
                            <div class="grid grid-cols-2 lg:grid-cols-2 gap-4">
                                <div class="relative mb-3">
                                    <x-label>Student Name</x-label>
                                    <x-input value="{{ $student->first_name }} {{ $student->last_name }}" disabled />
                                </div>
                                <div class="relative mb-3">
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



    </div>

@endsection
