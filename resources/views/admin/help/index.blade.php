@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h6 class="text-left text-2xl text-black ">
            Guide Area
        </h6>



    {{-- <x-grid columns="2" gap="4" px="0" mt="0">
        <div class="min-w-0 p-4 shadow-md bg-white ring-1 ring-black ring-opacity-5">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-semibold text-gray-800">
                    Total Number Of Offenses Used
                </h4>
                <x-dropdown>
                    <x-slot name="trigger">
                        <div class="flex items-center">
                            <button type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>
                    </x-slot>
                    <x-slot name="content">
                        <ul>
                            <li class="py-2 px-2 hover:text-green-400" data-year="All">All</li>
                            <li class="py-2 px-2 hover:text-green-400" data-year="{{ date('Y') }}-{{ date('Y') + 1 }}">Current Year</li>
                            <li class="py-2 px-2 hover:text-green-400" data-year="2021-2022">2021-2022</li>
                            <li class="py-2 px-2 hover:text-green-400" data-year="2022-2023">2022-2023</li>
                            <li class="py-2 px-2 hover:text-green-400" data-year="2023-2024">2023-2024</li>
                        </ul>

                    </x-slot>
                </x-dropdown>
            </div>

            <canvas id="barGradeLevel"></canvas>

            <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600">
                <div class="flex items-center">
                    <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>
                </div>
            </div>
        </div>




    </x-grid> --}}


    <div>
        {{-- Form --}}
        <x-form title="Grade: ">
            <x-slot name="actions">

                <x-link href="{{ url('admin/settings/classrooms') }}">
                    Back
                </x-link>
            </x-slot>

            <x-slot name="slot">

                <h6 class="text-sm mt-3 mb-6 px-4 font-bold uppercase">
                    Anecdotal Reports
                </h6>

                <form action="{{ route('report.pdf.test') }}" method="get" target="_blank">
                    <!-- Your form fields for selecting classroom and offense category -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Department</x-label>
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
                                <x-label>High Schools</x-label>
                                <x-select name="highSchool">
                                    <!-- Options for classrooms -->
                                    <option value="All">All Classroom</option>
                                    @foreach ($highSchools as $class)
                                        <option value="{{ $class->grade_level }}">Grade: {{ $class->grade_level }}
                                            {{ $class->section }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                        <div class="w-full px-4" id="seniorHighSelect" style="display: none;">
                            <div class="relative mb-3">
                                <x-label>Senior High</x-label>
                                <x-select name="SeniorHigh" >
                                    <!-- Options for classrooms -->
                                    <option value="All">All Classroom</option>
                                    @foreach ($seniorHigh as $classHigh)
                                        <option value="{{ $classHigh->grade_level }}">Grade: {{ $classHigh->grade_level }}
                                            {{ $class->section }}</option>
                                    @endforeach
                                </x-select>

                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">School Year: <span class="text-green-500 text-sm">June(this
                                        year)-May(next-year)</span></x-label>
                                <x-select name="year" required>
                                    <option value="All">All Year</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2023-2024">2023-2024</option>
                                </x-select>
                            </div>
                        </div>

                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">Status</x-label>
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


<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>




@endsection
