@extends('layouts.dashboard.index')
@section('content')
    {{-- Form --}}
    <x-form title="Grade: {{ $classroom->grade_level }} {{ $classroom->section }}">
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
                        <x-input value="Grade: {{ $classroom->grade_level }}" disabled />
                    </div>
                </div>


                <div class="w-full px-4">
                    <div class="relative mb-3">
                        <x-label for="section">Section</x-label>
                        <x-input value="{{ $classroom->section }}" disabled />

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
                        <x-label>Status</x-label>
                        <x-input value="{{ $classroom->getStatusTextAttribute() }}" disabled/>
                    </div>
                </div>
            </div>

        </x-slot>
    </x-form>

    @if ($classroom->students->count() > 0)
    <h6 class="text-xl font-bold px-4 text-left  my-5">
        List Of Students
    </h6>
    <x-table>
        <x-slot name="header">
            <th class="px-4 py-3">First Name</th>
            <th class="px-4 py-3">Last Name</th>
            <th class="px-4 py-3">LRN</th>
            <th class="px-4 py-3">Status</th>
        </x-slot>
        @foreach ($classroom->students as $student)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">{{ $student->first_name }}</td>
                <td class="px-4 py-3">{{ $student->last_name }}</td>
                <td class="px-4 py-3">{{ $student->lrn }}</td>
                <td class="px-4 py-3">{{ $student->getStatusTextAttribute() }}</td>

            </tr>
        @endforeach
    </x-table>
@else
<div class="mx-auto my-12">
    <p class="text-center">No students found for this classroom.</p>
</div>
@endif

@endsection
