@extends('layouts.dashboard.index')
@section('content')
{{-- Form --}}
    <x-form title="Add Classroom">
        <x-slot name="actions">
            {{-- Button --}}
            <x-link href="{{ url('admin/settings/classroom/create') }}">
                Back
            </x-link>
        </x-slot>

        <x-slot name="slot">
            <form action="{{ url('admin/settings/classroom/store') }}" method="POST">
                @csrf
                @method('POST')

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                Add New Classroom
                </h6>
                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            {{-- Label --}}
                            <x-label>Grade Level</x-label>
                            {{-- Input Select --}}
                            <x-select name="grade_level_id">
                                @foreach ($grade_levels as $id => $grade_level)
                                    <option value="{{ $id }}">{{ $grade_level }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Section</x-label>
                            <x-select name="section_id">
                                @foreach ($sections as $id => $section)
                                    <option value="{{ $id }}">{{ $section }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Adviser</x-label>
                            <x-select name="employee_id">
                                @foreach ($employees as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Status</x-label>
                            <x-select name="status">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </x-select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button type="submit">Add</x-button>
                </div>

                </form>


            <!-- Add any additional sections or form fields here -->
        </x-slot>
    </x-form>
@endsection
