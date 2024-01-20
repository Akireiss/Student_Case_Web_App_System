@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h2 class="m-1 text-2xl font-semibold text-gray-700  mb-3">
            Users Manual
        </h2>
        @if (auth()->user()->role == 1)
        <x-bread :breadcrumbs="[
            ['url' => url('admin/dashboard'), 'label' => 'Admin'],
            ['url' => url('help'), 'label' => 'Settings'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>
        @endif
        @if (auth()->user()->role == 2)
        <x-bread :breadcrumbs="[
            ['url' => url('adviser/dashboard'), 'label' => 'Adviser'],
            ['url' => url('help'), 'label' => 'Settings'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>
        @endif

        @if (auth()->user()->role == 0)
        <x-bread :breadcrumbs="[
            ['url' => url('home'), 'label' => 'Users'],
            ['url' => url('help'), 'label' => 'Help'],
            ['url' => url('help'), 'label' => 'Users Manual'],
        ]"/>

        @endif

        <div class="flex flex-col lg:flex-row space-y-4 lg:space-x-2">
            <!-- Manual Backup Form -->
            <div class="flex-1 lg:w-1/2 mt-4">
                <div class="bg-white p-4 shadow rounded-lg mt-4">
                    <h6 class="text-md my-1 font-bold uppercase mt-1">How To Report Student</h6>
                    <article class="prose lg:prose-xl">
                        <h3 class="text-md font-bold mb-2 mt-5">Step 1: Student Information</h3>
                        @if (auth()->user()->role == 1)
                        <p>
                            Go to  <a href="{{ url('admin/reports/create') }}"><span class="underline">Report </span></a>
                        </p>
                        @endif
                        @if (auth()->user()->role == 0)
                        <p>
                            Go to  <a href="{{ url('home') }}"><span class="underline">Report </span></a>
                        </p>
                        @endif
                        @if (auth()->user()->role == 2)
                        <p>
                            Go to  <a href="{{ url('adviser/dashboard') }}"><span class="underline">Report </span></a>
                        </p>
                        @endif
                        <h3 class="text-md font-bold mb-2 mt-5">Step 2: Student Information</h3>
                        <p>
                            First, you need to type at least three (3) letters of the student name you want to report to search. After clicking the student name it will automatically show the student classroom.
                        </p>

                        <h3 class="text-md font-bold mb-2 mt-5">Step 3: Case Information</h3>
                        <p>
                            This is the designated space where pertinent information regarding the student's case will be entered, allowing for a comprehensive overview and thorough documentation of the details
                        </p>

                        <h3 class="text-md font-bold mb-2 mt-5">Step 4: Additional Information</h3>
                        <p>
                            This section includes additional information about the student's case, providing insights into the severity or importance of the situation.
                        </p>

                        <h3 class="text-md font-bold mb-2 mt-5">Step 5: Actions Taken</h3>
                        <p>
                            This section enables the reporter to choose and review their recent actions with the student before initiating a report or referral to the Guidance Counselor or Admin.
                        </p>
                    </article>
                </div>
            </div>

            <div class="flex-1 lg:w-1/2">
                <div class="bg-white p-4 shadow rounded-lg mt-4">
                    <h6 class="text-md my-1 font-bold uppercase mt-1">How To Edit Reported Student

                    </h6>
                    <article class="prose lg:prose-xl">
                        <h3 class="text-md font-bold mb-2 mt-5">Step 1: Go To
                            @if (auth()->user()->role == 1)
                                <a href="{{ url('admin/report/history') }}"><span class="underline">Report History</span></a>
                            @endif

                            @if (auth()->user()->role == 2)
                                <a href="{{ url('adviser/report/history') }}"><span class="underline">Report History</span></a>
                            @endif

                            @if (auth()->user()->role == 0)
                                <a href="{{ url('report/history') }}"><span class="underline">Report History</span></a>
                            @endif
                        </h3>

                        <p>
                         After going to report history, click edit and it will redirect to page
                        </p>
                        <h3 class="text-md font-bold mb-2 mt-5">Step 2: Click Submit</h3>
                        <p>

                            After Clicking the submit you can now view the changes
                        </p>

                    </article>
                </div>
            </div>




        </div>

@can('adviser-access')

        <div class="flex flex-col lg:flex-row space-y-4 lg:space-x-2">
            <!-- Manual Backup Form -->
            <div class="flex-1 lg:w-1/2 mt-4">

            <div class="bg-white p-4 shadow rounded-lg mt-4">
                <h6 class="text-md my-1 font-bold uppercase mt-1">How To Reffer Student To Another Class

                </h6>
                <article class="prose lg:prose-xl">
                    <h3 class="text-md font-bold mb-2 mt-5">Step 1: Go To
                        @if (auth()->user()->role == 1)
                            <a href="{{ url('admin/settings/classrooms') }}"><span class="underline">Classrome tab and click edit</span></a>
                        @endif

                        @if (auth()->user('adviser/students')->role == 2)
                            <a href="{{ url('   adviser/student-profile/add') }}"><span class="underline">Refferal Page</span></a>
                        @endif

                    </h3>

                    <p>
                     After going to report history, click edit and it will redirect to page
                    </p>
                    <h3 class="text-md font-bold mb-2 mt-5">Step 2: Confirm Changes</h3>
                    <p>

                        Before submitting, the user has the option to review the information for the referred students. Additionally, the user can reload the page for further verification if needed.
                    </p>

                </article>
            </div>
        </div>

        </div>


@endcan

    </div>


@endsection
