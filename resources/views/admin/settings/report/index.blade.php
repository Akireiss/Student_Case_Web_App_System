@extends('layouts.dashboard.index')
@section('content')
    <div>


        <div>
            <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
                Generate Report
            </h2>
               <x-bread :breadcrumbs="[
                   ['url' => url('admin/dashboard'), 'label' => 'Admin'],
                   ['url' => url('admin/settings/generate-report'), 'label' => 'Settings'],
                   ['url' => url('admin/settings/generate-report'), 'label' => 'Generate Report'],
               ]"/>


            <x-form title="">
                <x-slot name="actions">

                    {{-- <x-link href="{{ url('admin/settings/classrooms') }}">
                        Back
                    </x-link> --}}
                </x-slot>

                <x-slot name="slot">

                    <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                        Generate Report
                    </h6>

                    <form action="{{ route('report.pdf.test') }}" method="get" target="_blank">
                        <!-- Your form fields for selecting classroom and offense category -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label for="section">Department<x-required/></x-label>
                                    <x-select name="department" id="departmentSelect">
                                        <!-- Options for offense categories -->
                                        <option value="All">All</option>
                                        <option value="0">High School</option>
                                        <option value="1">Senior High School</option>
                                    </x-select>
                                </div>
                            </div>


                            <div class="w-full px-4" id="highSchoolSelect" style="display: none;">
                                <div class="relative mb-3">
                                    <x-label>High Schools<x-required/></x-label>
                                    {{-- <x-select name="highSchool"> --}}
                                        <!-- Options for classrooms -->
                                        <x-input name="highSchool" value="All" readonly>All Classroom</x-input>
                                        {{-- @foreach ($highSchools as $class)
                                            <option value="{{ $class->grade_level }}">Grade: {{ $class->grade_level }}
                                                {{ $class->section }}</option>
                                        @endforeach --}}
                                    {{-- </x-select> --}}
                                </div>
                            </div>

                            <div class="w-full px-4" id="seniorHighSelect" style="display: none;">
                                <div class="relative mb-3">
                                    <x-label>Senior High<x-required/></x-label>
                                    {{-- <x-select name="SeniorHigh" > --}}
                                        <!-- Options for classrooms -->
                                        <x-input name="SeniorHigh" value="All" readonly>All Classroom</x-input>

                                        {{-- @foreach ($seniorHigh as $classHigh)
                                            <option value="{{ $classHigh->grade_level }}">Grade: {{ $classHigh->grade_level }}
                                                {{ $class->section }}</option>
                                        @endforeach --}}
                                    {{-- </x-select> --}}

                                </div>
                            </div>


                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label for="section">School Year:<x-required/> <span class="text-green-500 text-sm">June(this
                                            year)-May(next-year)</span></x-label>
                                    <x-select name="year" required>
                                        {{-- <option value="All">All Year</option> --}}
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2023-2024">2023-2024</option>
                                    </x-select>
                                </div>
                            </div>

                            <div class="w-full px-4">
                                <div class="relative mb-3">
                                    <x-label for="section">Status<x-required/></x-label>
                                    <x-select name="status" required>
                                        <option value="All">All</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Ongoing</option>
                                        <option value="2">Resolved</option>
                                        <option value="3">Follow Up</option>
                                        <option value="4">Refferal</option>
                                    </x-select>
                                </div>
                            </div>

                        </div>


                        <div class="flex justify-end px-4">
                            <div class="relative mb-3">
                                <x-button type="submit">Generate PDF</x-button>
                            </div>
                        </div>
                    </form>



                </x-slot>
            </x-form>
        </div>

        </div>

        <script>
            const departmentSelect = document.getElementById('departmentSelect');
            const highSchoolSelect = document.getElementById('highSchoolSelect');
            const seniorHighSelect = document.getElementById('seniorHighSelect');

            departmentSelect.addEventListener('change', function() {
                if (departmentSelect.value === '0') {
                    highSchoolSelect.style.display = 'block';
                    seniorHighSelect.style.display = 'none';
                } else if (departmentSelect.value === '1') {
                    highSchoolSelect.style.display = 'none';
                    seniorHighSelect.style.display = 'block';
                } else {
                    highSchoolSelect.style.display = 'none';
                    seniorHighSelect.style.display = 'none';
                }
            });
        </script>

@endsection
