<div>

        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Dashboard
        </h2>
{{--
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">

        <div class="bg-red-500 border-l-4 text-white p-2.5 mb-1 shadow-md hidden-alert-weekly" role="alert" id="weekly-alert">
            <p class="font-bold">Notice</p>
            <p>Class Reports Today: <span id="weekly-report-count-class">{{ $dailyReportCount }}</span></p>
        </div>

        <div class="bg-red-500 border-l-4 text-white p-2.5 mb-1 shadow-md hidden-alert-weekly" role="alert" id="weekly-alert">
            <p class="font-bold">Notice</p>
            <p>Total Reports This Week: <span id="weekly-report-count-class">{{ $weeklyReportCount }}</span></p>
        </div>
        </div> --}}



        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-md  dark:bg-gray-800"
                wire:poll="updateLiveCard"
            >
                <div
                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                        ></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-xl font-medium text-gray-600 ">
                        Total students
                    </p>
                           <p class="text-3xl font-semibold text-gray-700 ">
                        {{ $totalStudents }}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-md  dark:bg-gray-800"  wire:poll="updateLiveCard"
            >
                <div
                    class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25
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
                           <p class="text-3xl font-semibold text-gray-700 ">
                        {{ $totalCases }}

                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-md  dark:bg-gray-800"   wire:poll="updateLiveCard"
            >
                <div
                    class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                  </svg>

                </div>
                <div>
                    <p class="mb-2 text-xl font-medium text-gray-600 ">
                      Pending Cases
                    </p>
                           <p class="text-3xl font-semibold text-gray-700 ">
                        {{ $pendingCases }}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div
                class="flex items-center p-4 bg-white rounded-lg shadow-md  dark:bg-gray-800"   wire:poll="updateLiveCard"
            >
                <div
                    class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
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
            </div>
        </div>





@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('refreshCard', function () {
                Livewire.emit('updateCard');
            });

            document.addEventListener('start-polling', function (event) {
                var interval = event.detail.interval;

                setInterval(function () {
                    Livewire.emit('updateCard');
                }, interval);
            });
        });
    </script>
@endpush




</div>
