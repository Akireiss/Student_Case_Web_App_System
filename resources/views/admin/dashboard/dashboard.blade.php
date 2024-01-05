@extends('layouts.dashboard.index')

@section('content')
    <div>
        {{--
        <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
            Dashboard
        </h2> --}}
        <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
            Dashboard
        </h2>
        <x-bread :breadcrumbs="[
            ['url' => url('admin/dashboard'), 'label' => 'Admin'],
            ['url' => url('admin/dashboard'), 'label' => 'Dashboard'],
        ]" />



        @foreach ($delayedNotif as $notification)
            <div class="bg-red-100 border border-red-400 text-black px-4 py-2 rounded relative my-3 ">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <span class="block sm:inline mb-2 sm:mb-0 pr-4">{{ $notification->data['message'] }}</span>
                    <span class="block sm:inline">
                        <a class="hover:underline px-6 py-1 "
                            href="{{ url('admin/student/recent-cases/' . $notification->data['link']) }}">
                            View Recent Cases
                        </a>
                    </span>
                </div>
                <span class="absolute top-0 bottom-0 right-0 px-2 py-2">
                    <button type="button" class="mark-as-read" data-notification-id="{{ $notification->id }}">
                        <svg class="fill-current h-6 w-6 text-black"
                        role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </button>
                </span>
            </div>
        @endforeach





        <div x-data="{ currentGrid: 'totalStatusCases', yearButtonText: '{{ date('Y') }}-{{ date('Y') + 1 }}', statusButtonText: 'Case Status' }">

            <div class="flex justify-end items-center space-x-2 mb-2">


                <div id="statusDropdown">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <div class="flex items-center">
                                <button type="button"
                                    class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50  rounded-md shadow-sm text-gray-800 flex items-center">
                                    <span x-html="statusButtonText"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </div>

                        </x-slot>
                        <x-slot name="content">
                            <ul>
                                <li class="py-2 px-3 hover:bg-gray-200 cursor-pointer"
                                    @click="currentGrid = 'totalStudents'; statusButtonText = 'Students'">Students</li>
                                <li class="py-2 px-3 hover:bg-gray-200 cursor-pointer"
                                    @click="currentGrid = 'totalFMstudents'; statusButtonText = 'Student Cases'">Student
                                    Cases</li>
                                <li class="py-2 px-3 hover:bg-gray-200 cursor-pointer"
                                    @click="currentGrid = 'totalStatusCases'; statusButtonText = 'Cases Status'">Cases
                                    Status</li>
                            </ul>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>






            <div x-show="currentGrid === 'totalStudents'" class="grid gap-6 mb-3 md:grid-cols-3 xl:grid-cols-3"
                id="totalStudents">
                <!-- Card -->

                <a href="{{ url('admin/settings/students/filtered/active') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg border-l-4  ">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Total Active Students
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 ">
                            {{ $totalStudents }}
                        </p>
                    </div>
                </a>



                <a href="{{ url('admin/settings/students/filtered/male') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg   border-l-4 ">
                    <div
                        class=" p-3 mr-4 text-white bg-blue-500 rounded-full dark:text-orange-100
                 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div role="alert" id="weekly-alert">
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Total Active Male
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 " >
                                    {{ $totalMale }}
                        </p>
                    </div>
                </a>





                <a href="{{ url('admin/settings/students/filtered/female') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg   border-l-4 ">
                    <div class=" p-3 mr-4 text-white bg-pink-500 rounded-full">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                            </path>
                        </svg>
                    </div>
                    <div role="alert" id="weekly-alert">
                        <p class="mb-2 text-lg font-medium text-gray-600">
                            Total Active Female
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 " >
                        {{ $totalFemale }}
                        </p>
                    </div>
                </a>

            </div>

            <div x-show="currentGrid === 'totalFMstudents'" class="grid gap-6 mb-3 md:grid-cols-3 xl:grid-cols-3" x-cloak
                id="totalFMstudents">


                <!-- Card -->
                <a href="{{ url('admin/reports') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg border-l-4">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25
                                                                0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664
                                                                 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0
                                                                  1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621
                                                                   0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>



                    </div>
                    <div>
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Total Cases
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 " >
                            {{ $totalCases }}
                        </p>
                    </div>
                </a>
                <!-- Card -->
                <a href="{{ url('admin/reports/male') }}" class="flex items-center p-4 bg-white shadow-md border-l-4 ">
                    <div class="p-3 mr-4 text-white bg-blue-500 rounded-full ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" height="1em"
                            viewBox="0 0 320 512" fill="white">
                            <path
                                d="M96 64a64 64 0 1 1 128 0A64 64 0 1 1 96 64zm48 320v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V287.8L59.1 321c-9.4 15-29.2 19.4-44.1 10S-4.5 301.9 4.9 287l39.9-63.3C69.7 184 113.2 160 160 160s90.3 24 115.2 63.6L315.1 287c9.4 15 4.9 34.7-10 44.1s-34.7 4.9-44.1-10L240 287.8V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V384H144z" />
                        </svg>
                    </div>
                    <div>
                        <p class="mb-2 text-lg font-medium text-gray-600">
                            Male Cases
                        </p>
                        <p class="text-3xl font-semibold text-gray-700" >
                            {{ $maleCases }}
                        </p>
                    </div>
                </a>

                <!-- Card -->
                <a href="{{ url('admin/reports/female') }}"
                    class="flex items-center p-4 bg-white  border-l-4 shadow-md rounded-lg">
                    <div class="p-3 mr-4 text-white bg-pink-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500" height="1em"
                            viewBox="0 0 320 512" fill="white">
                            <path
                                d="M160 0a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM88 384H70.2c-10.9 0-18.6-10.7-15.2-21.1L93.3 248.1 59.4 304.5c-9.1
                                                                15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l53.6-89.2c20.3-33.7 56.7-54.3 96-54.3h11.6c-39.3 0 75.7 20.6 96 54.3l53.6 89.2c9.1
                                                                15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9l-33.9-56.3L265 362.9c3.5 10.4-4.3 21.1-15.2 21.1H232v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384H152v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z" />
                        </svg>
                    </div>

                    <div>
                        <p class="mb-2 text-lg font-medium text-gray-600">
                            Female Cases
                        </p>
                        <p  class="text-3xl font-semibold text-gray-700">

                            {{ $femaleCases }}
                        </p>
                    </div>
                </a>



            </div>

            <div x-cloak x-show="currentGrid === 'totalStatusCases'" class="grid gap-6 mb-3 md:grid-cols-3 xl:grid-cols-3"
                id="totalStatusCases">


                <!-- Card -->

                <!-- Card -->
                <a href="{{ url('admin/reports/pending') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg border-l-4
            ">
                    <div class="p-3 mr-4 text-white bg-red-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                    </div>
                    <div>
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Pending Cases
                        </p>
                        <p  class="text-3xl font-semibold text-gray-700 ">
                        {{ $pendingCases }}
                        </p>
                    </div>
                </a>

                <a href="{{ url('admin/reports/ongoing') }}"
                    class="flex items-center p-4 bg-white  shadow-md rounded-lg  border-l-4 ">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25
                                                                0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664
                                                                 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0
                                                                  1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621
                                                                   0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>



                    </div>
                    <div>
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Ongoing
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 ">
                            {{ $ongoingCases }}
                        </p>
                    </div>
                </a>

                <!-- Card -->
                <a href="{{ url('admin/reports/resolved') }}"
                    class="flex items-center p-4 bg-white  border-l-4 rounded-lg
              shadow-md  ">
                    <div class="p-3 mr-4 text-white bg-green-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                        </svg>

                    </div>

                    <div>
                        <p class="mb-2 text-xl font-medium text-gray-600 ">
                            Resolved Cases
                        </p>
                        <p class="text-3xl font-semibold text-gray-700 ">
                            {{ $resolvedCases }}
                        </p>
                    </div>
                </a>


            </div>
        </div>


        {{--
        <div class="grid gap-6 mb-3 md:grid-cols-2 xl:grid-cols-4">


            <a href="{{ url('admin/resolved-cases') }}">

                <div class="py-1">
                    <div class=" p-4 bg-white
                     shadow-md mb-1 " role="alert"
                        id="weekly-alert">
                        <p class="font-bold">Notice</p>
                        <p>Resolved Cases This Week:
                            <span id="resolved-cases-count"></span>
                        </p>
                    </div>
                </div>
            </a>




            <a href="{{ url('') }}" class="py-1">
                <div class=" p-4 bg-white
            shadow-md hidden-alert-weekly" role="alert"
                    id="weekly-alert">
                    <p class="font-bold">Notice</p>
                    <p>Total Reports This Week: <span id="weekly-report-count" class="underline"></span></p>
                </div>
            </a>



            <div class="py-1">
                <div class=" p-4 bg-white
         shadow-md hidden-alert-monthly" role="alert"
                    id="monthly-alert">
                    <p class="font-bold">Notice</p>
                    <p>Total Reports This Month: <span id="monthly-report-count"></span></p>
                </div>
            </div>



        </div> --}}


        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2 mt-3">

            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 ">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-semibold text-gray-800">
                        Total Number Of Case Status
                    </h4>
                    <div>
                        <select name="case_year" id="case_year"
                            class="border border-gray-300 p-2 bg-gray-50
                        rounded-md shadow-sm w-full text-gray-800 hover:bg-gray-100">
                            <option value="All">All</option>
                            <option selected value="{{ date('Y') }}-{{ date('Y') + 1 }}">
                                {{ date('Y') }}-{{ date('Y') + 1 }}</option>
                            <option value="2021-2022">2021-2022</option>

                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                        </select>
                    </div>
                </div>


                <canvas id="bar"></canvas>

            </div>

            <div class="min-w-0 p-4 shadow-md bg-white ring-1 ring-black ring-opacity-5">
                <div class="flex justify-between ">
                    <h4 class="font-semibold text-gray-800">
                        Grade Level Offenses
                    </h4>
                    <div class="flex space-x-2">

                        <div>
                            <select name="level_offense_year" id="level_offense_year"
                                class="border border-gray-300 p-2 bg-gray-50
                                rounded-md shadow-sm w-full text-gray-800 hover:bg-gray-100">
                                <option value="All">All</option>
                                <option selected value="{{ date('Y') }}-{{ date('Y') + 1 }}">
                                    {{ date('Y') }}-{{ date('Y') + 1 }}</option>
                                <option value="2021-2022">2021-2022</option>

                                <option value="2022-2023">2022-2023</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2024-2025">2024-2025</option>
                            </select>
                        </div>
                        <div>
                            <select
                                class="hover:bg-gray-100 border border-gray-300 p-2 bg-gray-50 rounded-md shadow-sm text-gray-800"
                                id="classroom_chart_year">
                                <option selected>Select Classroom</option>

                            </select>
                        </div>

                    </div>

                </div>

                <div>
                    {{-- The default chart --}}
                    <canvas id="barGradeLevel"></canvas>

                    {{-- The classroom chart --}}
                    <div id="barClassroom" class="hidden">
                        <canvas id="myChartClassroom"></canvas>
                    </div>
                </div>


                <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600">
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>
                        <!-- You can add text or other content here -->
                    </div>
                    <!-- Add more elements as needed -->
                </div>
            </div>




            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 ">
                <div class="flex justify-between ">
                    <h4 class="font-semibold text-gray-800">
                        Total Number Of Offense
                    </h4>
                    <div>
                        <select name="number_offense_year" id="number_offense_year"
                            class="border border-gray-300 p-2 bg-gray-50
                        rounded-md shadow-sm w-full text-gray-800 hover:bg-gray-100">
                            <option value="All">All</option>
                            <option selected value="{{ date('Y') }}-{{ date('Y') + 1 }}">
                                {{ date('Y') }}-{{ date('Y') + 1 }}</option>
                            <option value="2021-2022">2021-2022</option>

                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                        </select>
                    </div>
                </div>
                {{-- <canvas id="myChartPie"></canvas>//Temporary --joshua --}}
                <canvas id="OffenseChart"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600 ">
                    <!-- Chart legend -->
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>
                    </div>

                </div>
            </div>



            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 ">
                <div class="flex justify-between ">
                    <h4 class="font-semibold text-gray-800">
                        Total Number Of Succesfull Actions
                    </h4>
                    <div>
                        <select name="number_actions_year" id="number_actions_year"
                            class="border border-gray-300 p-2 bg-gray-50
                        rounded-md shadow-sm w-full text-gray-800 hover:bg-gray-100">
                            <option value="All">All</option>
                            <option selected value="{{ date('Y') }}-{{ date('Y') + 1 }}">
                                {{ date('Y') }}-{{ date('Y') + 1 }}</option>
                            <option value="2021-2022">2021-2022</option>

                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                        </select>
                    </div>
                </div>
                {{-- <canvas id="myChart"></canvas> --}}
                <canvas id="myPieChart"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600 ">
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>

                    </div>

                </div>
            </div>



        </div>
    </div>


    </div>

    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            function fetchNewNotifications() {
                $.ajax({
                    type: 'GET',
                    url: '/fetch-new-notifications',
                    success: function(data) {

                    }
                });
            }

            fetchNewNotifications();

            var refreshInterval = 30000;
            setInterval(fetchNewNotifications, refreshInterval);

            // Function to mark notification as read
            function markNotificationAsRead(notificationId, notificationElement) {
                $.ajax({
                    type: 'POST',
                    url: '/mark-notification-read/' + notificationId,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        notificationElement.fadeOut();
                    }
                });
            }

            $('.mark-as-read').click(function() {
                var notificationId = $(this).data('notification-id');
                var notificationElement = $(this).closest('.bg-red-100');

                markNotificationAsRead(notificationId, notificationElement);
            });

            $('.close-notification').click(function() {
                var notificationElement = $(this).closest('.bg-red-100');
                notificationElement.fadeOut();
            });
        });
    </script>

    <script>
        const dropdown = document.getElementById('dropdown');
        const selectedYearSpan = document.getElementById('selectedYear');
        const listItems = dropdown.querySelectorAll('li');

        dropdown.addEventListener('click', function(event) {
            const target = event.target;

            if (target.tagName === 'LI') {
                selectedYearSpan.textContent = target.dataset.year;

            }
        });
    </script>
@endsection
