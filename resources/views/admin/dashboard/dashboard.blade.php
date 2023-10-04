@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h2 class="m-1 text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-3">
            Dashboard
        </h2>


        <div class="grid gap-6 mb-3 md:grid-cols-3 xl:grid-cols-3">
            <!-- Card -->

            <a href="{{ url('admin/settings/students') }}"
                class="flex items-center p-4 bg-white  shadow-md  dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total students
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="total-students">

                    </p>
                </div>
            </a>



            <a href="{{ url('admin/settings/students') }}"
                class="flex items-center p-4 bg-white  shadow-md  dark:bg-gray-800 border-l-4 border-blue-500">
                <div
                    class=" p-3 mr-4 text-white bg-blue-500 rounded-full dark:text-orange-100
                 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div role="alert" id="weekly-alert>
                <p class=" mb-2 text-sm font-medium text-gray-600
                    dark:text-gray-400">
                    Total Male
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="total-male">

                    </p>
                </div>
            </a>





            <a href="{{ url('admin/settings/students') }}"
                class="flex items-center p-4 bg-white  shadow-md  dark:bg-gray-800 border-l-4 border-pink-500">
                <div class=" p-3 mr-4 text-white bg-pink-500 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div role="alert" id="weekly-alert>
                <p class=" mb-2 text-sm font-medium text-gray-600
                    dark:text-gray-400">
                    Total Female
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="total-female">

                    </p>
                </div>
            </a>

        </div>







        <div class="grid gap-6 mb-3 md:grid-cols-3 xl:grid-cols-3">


            <!-- Card -->
            <a href="{{ url('admin/reports') }}" class="flex items-center p-4 bg-white  shadow-md  dark:bg-gray-800">
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
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Cases
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200" id="total-cases">
                    </p>
                </div>
            </a>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white  shadow-md border-l-4 border-red-500
            dark:bg-gray-800">
                <div class="p-3 mr-4 text-white bg-red-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>

                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pending Cases
                    </p>
                    <p id="pending-cases" class="text-lg font-semibold text-gray-700 dark:text-gray-200">

                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white border-green-500 border-l-4
              shadow-md  dark:bg-gray-800">
                <div class="p-3 mr-4 text-white bg-green-500 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                    </svg>

                </div>

                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Resolved Cases
                    </p>
                    <p id="resolved-cases" class="text-lg font-semibold text-gray-700 dark:text-gray-200">

                    </p>
                </div>
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

            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 dark:bg-gray-800">
                <div class="flex justify-between items-start">

                    <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                        Total Number Of Case Status
                    </h4>


                </div>


                <canvas id="bars"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    <!-- Chart legend -->
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-red-500 rounded-full"></span>
                        <span>Pending</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-yellow-400 rounded-full bg-primary-600"></span>
                        <span>Ongoing</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 bg-green-600 rounded-full bg-primary-600"></span>
                        <span>Resolved</span>
                    </div>
                </div>
            </div>



            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Total Number Of Offenses
                </h4>
                <canvas id="myChartPie"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    <!-- Chart legend -->
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>
                        <span>Offenses</span>
                    </div>

                </div>
            </div>



            <div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 dark:bg-gray-800">
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                    Total Number Of Successfull Actions
                </h4>
                <canvas id="myChart"></canvas>
                <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>
                        <span>Succesfull Actions</span>
                    </div>

                </div>
            </div>



        </div>
    </div>
@endsection
