
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

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
               Classroom Details
                </h6>
                <!-- Personal information form fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            {{-- Label --}}
                            <x-label>Grade Level</x-label>
                            {{-- Input Select --}}
                            <x-select name="grade_level" disabled>
                                <option value="7" {{ $classroom->grade_level == '7' ? 'selected' : '' }}>7</option>
                                <option value="8" {{ $classroom->grade_level == '8' ? 'selected' : '' }}>8</option>
                                <option value="9" {{ $classroom->grade_level == '9' ? 'selected' : '' }}>9</option>
                                <option value="10" {{ $classroom->grade_level == '10' ? 'selected' : '' }}>10</option>
                                <option value="11" {{ $classroom->grade_level == '11' ? 'selected' : '' }}>11</option>
                                <option value="12" {{ $classroom->grade_level == '12' ? 'selected' : '' }}>12</option>
                            </x-select>
                        </div>
                    </div>


    <div class="w-full px-4">
        <div class="relative mb-3">
            <x-label for="section">Section</x-label>
            <x-select name="section" id="section"  disabled>
                <option value="Jupiter" {{ $classroom->section == 'Jupiter' ? 'selected' : '' }}>Jupiter</option>
                <option value="Akasya" {{ $classroom->section == 'Akasya' ? 'selected' : '' }}>Akasya</option>
                <option value="Earth" {{ $classroom->section == 'Earth' ? 'selected' : '' }}>Earth</option>
                <option value="Sun" {{ $classroom->section == 'Sun' ? 'selected' : '' }}>Sun</option>
                <option value="Neptune" {{ $classroom->section == 'Neptune' ? 'selected' : '' }}>Neptune</option>
                <option value="Pluto" {{ $classroom->section == 'Pluto' ? 'selected' : '' }}>Pluto</option>
                <option value="Venus" {{ $classroom->section == 'Venus' ? 'selected' : '' }}>Venus</option>
            </x-select>
        </div>
    </div>

    <div class="w-full px-4">
        <div class="relative mb-3">
            <x-label>Adviser</x-label>
            <x-select name="employee_id"  disabled>
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
                            <x-select name="status"  disabled>
                                <option value="0" {{ $classroom->status == 0 ? 'selected' : '' }}>Active</option>
                                <option value="1" {{ $classroom->status == 1 ? 'selected' : '' }}>Inactive</option>
                            </x-select>
                        </div>
                    </div>
                </div>


            <!-- Add any additional sections or form fields here -->
        </x-slot>
    </x-form>

    @if ($classroom)
    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
        Students
    </h6>
    <x-table>
        <x-slot name="header">
            <th class="px-4 py-3">First Name</th>
            <th class="px-4 py-3">Last Name</th>
            <th class="px-4 py-3">LRN</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Manage</th>
        </x-slot>
        @foreach ($classroom->student as $student)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">{{ $student->first_name }}</td>
                <td class="px-4 py-3">{{ $student->last_name }}</td>
                <td class="px-4 py-3">{{ $student->lrn }}</td>
                <td class="px-4 py-3">{{ $student->status }}</td>
                <td class="px-4 py-3">
                    <!-- Add any management actions for the student here -->
                </td>
            </tr>
        @endforeach
    </x-table>
@else
    <p>No students found for this classroom.</p>
@endif

@endsection

