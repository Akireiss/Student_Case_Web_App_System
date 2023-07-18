
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
                            <x-select name="grade_level_id">
                                    <option value="7">7</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="w-full px-4">
                        <div class="relative mb-3">
                            <x-label>Section</x-label>
                            <x-select name="section">
                                    <option value="Jupiter">Jupiter</option>
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


            <!-- Add any additional sections or form fields here -->
        </x-slot>
    </x-form>

    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
        Classroom Details
         </h6>
         <x-table>
            <x-slot name="header">
                <th class="px-4 py-3">Student Name</th>
                <th class="px-4 py-3">Case Status</th>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Manage</th>
            </x-slot>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">

                    </td>
                    <td class="px-4 py-3">

                    </td>
                    <td class="px-4 py-3">

                    </td>
                    <td class="px-4 py-3">

                    </td>

                </tr>
        </x-table>
@endsection

