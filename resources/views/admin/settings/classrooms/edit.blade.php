@extends('layouts.dashboard.index')
@section('content')
    <x-form title="Edit Classroom">
        <x-slot name="actions">
            <x-link href="{{ url('admin/settings/classrooms') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Edit Classroom
                </h6>

                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Grade Level</x-label>
                            <x-select name="grade_level_id">
                                @foreach ($grade_levels as $id => $grade_level)
                                    <option value="{{ $id }}" {{ $classroom->grade_level_id == $id ? 'selected' : '' }}>
                                        {{ $grade_level }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Section</x-label>
                            <x-select name="section_id">
                                @foreach ($sections as $id => $section)
                                    <option value="{{ $id }}" {{ $classroom->section_id == $id ? 'selected' : '' }}>
                                        {{ $section }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Adviser</x-label>
                            <x-select name="employee_id">
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}" {{ $classroom->employee_id == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Status</x-label>
                            <x-select name="status">
                                <option value="0" {{ $classroom->status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $classroom->status == 1 ? 'selected' : '' }}>Inactive</option>
                            </x-select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Update</x-button>
                </div>
            </form>



            <!-- Add any additional sections or form fields here -->
        </x-slot>
    </x-form>
@endsection
