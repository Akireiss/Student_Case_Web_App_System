<button type="button"
    class="transition duration-300 ease-in-out bg-green-500 hover:bg-green-600 text-white text-sm tracking-wider px-4 py-2 rounded-sm"
    x-data="{ id: 'modal-example' }" x-on:click="$dispatch('modal-overlay',{id})">
    Modal
</button>

<div x-cloak
    class="fixed inset-0 z-10 flex flex-col items-center justify-end overflow-y-auto bg-gray-600 bg-opacity-50 sm:justify-start"
    x-data="{ modal: false }" x-show="modal" x-on:modal-overlay.window="if ($event.detail.id == 'modal-example') modal=true"
    x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="w-full px-2 py-20 transition-all transform sm:max-w-2xl" role="dialog" aria-modal="true"


        aria-labelledby="modal-headline" x-show="modal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave=" ease-in duration-300"
        x-transition:leave-start="opacity-100 t"

        x-transition:leave-end="opacity-0" x-on:click.away="modal=false">
        <!-- MODAL CONTAINER -->
        <div
            class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-sm shadow-xl">
            <div class="flex items-start justify-between p-4 border-b border-gray-300 rounded-t">
                <h5 class="mb-0 text-lg leading-normal">Awesome Modal</h5>
                <button type="button" class="close" x-on:click="close()">&times;</button>
            </div>
            <div class="relative flex p-4">
                ...
            </div>
            <div class="flex items-center justify-end p-4 border-t border-gray-300">
                <button x-on:click="close()" type="button"
                    class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-gray-600 mr-2">Close</button>
                <button type="button"
                    class="inline-block font-normal text-center px-3 py-2 leading-normal text-base rounded cursor-pointer text-white bg-blue-600">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>



{{-- Test --}}

<div class="min-w-0 p-4 shadow-md bg-white  ring-1 ring-black ring-opacity-5 ">
    <h4 class="mb-4 font-semibold text-gray-800 ">
        Grade Level Offenses
    </h4>
    <canvas id="bar-chart"></canvas>
    <div class="flex justify-center mt-4 space-x-3 text-lg text-gray-600 ">
        <div class="flex items-center">
            <span class="inline-block w-3 h-3 mr-1 rounded-full"></span>

        </div>

    </div>
</div>
@push('scripts')
    <script>
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: @json(array_column($data, 'grade_level')),
                datasets: [{
                        label: "Pending",
                        backgroundColor: "#3e95cd",
                        data: @json(array_column($data, 'pending')),
                    },
                    {
                        label: "Ongoing",
                        backgroundColor: "#8e5ea2",
                        data: @json(array_column($data, 'ongoing')),
                    },
                    {
                        label: "Resolved",
                        backgroundColor: "#3cba9f",
                        data: @json(array_column($data, 'resolved')),
                    },
                    {
                        label: "FollowUp",
                        backgroundColor: "#3e95cd",
                        data: @json(array_column($data, 'follow_up')),
                    },
                    {
                        label: "Referral",
                        backgroundColor: "#8e5ea2",
                        data: @json(array_column($data, 'referral')),
                    },
                ],
            },
            options: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Grade Level Offenses'
                }
            },
        });
    </script>
@endpush
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>












{{-- Pdf --}}

@if ($classroom !== "All")
<div class="my-2">
    <p class="text-left text-xl">
        Grade: {{ $classroom->grade_level }} {{ $classroom->section }}
    </p>
    <p>

        Total: {{ $anecdotals->count() }}

        Case Status:
        @if ($status == 'All')
            All
        @endif
        @if ($status == 0)
            Pending
        @endif

        @if ($status == 1)
            Ongoing
        @endif

        @if ($status == 2)
            Resvold
        @endif


        @if ($status == 3)
            Fllo Up
        @endif

    </p>


    @if ($classroom->students)
        @foreach ($classroom->students as $student)
            <li>{{ $student->first_name }}
                @if ($status == 'All')
                    {{ $student->anecdotal->count() }}
                @else
                    {{ $student->anecdotal->where('case_status', $status)->count() }}
                @endif

            </li>
        @endforeach
    @endif




@else


    <div>
        All Reports From All Classroom
    </div>

    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td>Pending</td>
                <td>Ongoing</td>
                <td>Resolved</td>
                <td>Follow Up</td>
                <td>Referral</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{ $anecdotals->where('case_status', 0)->count() }}
                </td>
                <td>
                    {{ $anecdotals->where('case_status', 1)->count() }}</td>
                <td>
                    {{ $anecdotals->where('case_status', 2)->count() }}</td>
                <td>
                    {{ $anecdotals->where('case_status', 3)->count() }}</td>
                <td>
                    {{ $anecdotals->where('case_status', 4)->count() }}</td>
            </tr>
            <tr>
                @foreach ($classroom as $class)
                <tr>
                    <td>{{ $class->grade_level }}</td>
                    <td>{{ $class->section }}</td>
                    <td>{{ $class->students->anecdotal->count() }}</td>
                </tr>
            @endforeach

            </tr>
        </tbody>
    </table>
@endif

</div>












///

@foreach ($classroom->students as $student)
                        <tr>
                            <td>{{ $student->first_name }}</td>
                            @if ($status == 'All')
                                <td>Total Case: {{ $student->anecdotal->count() }}</td>
                            @endif

                            @if ($status == 0)
                                <td>Total Pending Case:
                                    {{ $student->anecdotal->filter(function ($anecdotal) use ($category) {
                                            return $anecdotal->offenses->where('category', $category)->count() > 0;
                                        })->where('case_status', $status)->count() }}
                                </td>
                            @endif

                            @if ($status == 1)
                                <td>Total Ongoing Case:
                                    {{ $student->anecdotal->filter(function ($anecdotal) use ($category) {
                                            return $anecdotal->offenses->where('category', $category)->count() > 0;
                                        })->where('case_status', $status)->count() }}
                                </td>
                            @endif

                            @if ($status == 2)
                                <td>Total Resolved Case:
                                    {{ $student->anecdotal->filter(function ($anecdotal) use ($category) {
                                            return $anecdotal->offenses->where('category', $category)->count() > 0;
                                        })->where('case_status', $status)->count() }}
                                </td>
                            @endif

                            @if ($status == 3)
                                <td>Total Followup Case:
                                    {{ $student->anecdotal->filter(function ($anecdotal) use ($category) {
                                            return $anecdotal->offenses->where('category', $category)->count() > 0;
                                        })->where('case_status', $status)->count() }}
                                </td>
                            @endif


                            @if ($status == 4)
                                <td>Total Refferal Case:
                                    {{ $student->anecdotal->filter(function ($anecdotal) use ($category) {
                                            return $anecdotal->offenses->where('category', $category)->count() > 0;
                                        })->where('case_status', $status)->count() }}
                                </td>
                            @endif

                        </tr>
                    @endforeach














                    public function generateReportPDF(Request $request)
    {
        $request->validate([
            'selectedClassroom' => 'required',
            'selectedCategory' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        $department = $request->input('department', 'All');

        $highSchool = $request->input('highSchool', 'All');

        $SeniorHigh = $request->input('SeniorHigh', 'All');

        $category = $request->input('selectedCategory', 'All');

        $year = $request->input('year', 'All');

        $status = $request->input('status', 'All');



        $SeniorId = $request->input('SeniorHigh');

        $highSchoolId = $request->input('highSchool');

        // Retrieve a single classroom instance
        $highSchoolIds = Classroom::where('id', $highSchoolId)->first();
        $seniorHighSchool = Classroom::where('id', $SeniorId)->first();

        $anecdotals = Anecdotal::query();

        // if ($classroomId !== 'All') {
        //     $anecdotals->whereHas('students', function ($query) use ($classroomId) {
        //         $query->where('classroom_id', $classroomId);
        //     });
        // }

        if ($department === 'All') {
            $anecdotals->where('case_status', $status);
        }

        if ($highSchool !== 'All') {
            $anecdotals->whereHas('students', function ($query) use ($highSchoolIds) {
                $query->whereIn('classroom_id', $highSchoolIds);
            });
        } else {
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 0);
            });
        }


        if ($SeniorHigh !== 'All') {
            $anecdotals->whereHas('students', function ($query) use ($seniorHighSchool) {
                $query->whereIn('classroom_id', $seniorHighSchool);
            });
        } else {
            $anecdotals->whereHas('students', function ($query) {
                $query->where('department', 1);
            });
        }

        if ($category !== 'All') {
            $anecdotals->whereHas('offenses', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        if ($year !== 'All') {
            // Calculate the start and end dates for the selected year
            $yearParts = explode('-', $year);
            $startYear = Carbon::create($yearParts[0], 6, 1);
            $endYear = Carbon::create($yearParts[1], 5, 31)->endOfDay();

            $anecdotals->whereBetween('created_at', [$startYear, $endYear]);
        }

        if ($status !== 'All') {
            $anecdotals->where('case_status', $status);

        }

        // if ($status !== 'All') {
        //     $anecdotals->whereHas('offenses', function ($query) use ($status) {
        //         $query->where('status', 0);
        //     })->where('case_status', $status);

        // }
        // Get the data based on the query
        $anecdotals = $anecdotals->get();

        $allClassroom = Classroom::where('status', 0)->get();

        // Generate and stream the PDF
        $pdf = PDF::loadView('pdf.report', [
            'seniorHighSchool' => $seniorHighSchool,
            'highSchoolIds' =>  $highSchoolIds,
            'category' => $category,
            'anecdotals' => $anecdotals,
            'status' => $status,
            'year' => $year,
            'allClassroom' => $allClassroom
        ]);



        return $pdf->stream('report.pdf');
    }











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


    {{-- <div>
        {{-- Form
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
                                    <x-input name="highSchool" value="All" readonly>All Classroom</x-input>
                                    {{-- @foreach ($highSchools as $class)
                                        <option value="{{ $class->grade_level }}">Grade: {{ $class->grade_level }}
                                            {{ $class->section }}</option>
                                    @endforeach --}}
                                {{-- </x-select>
                            </div>
                        </div>

                        <div class="w-full px-4" id="seniorHighSelect" style="display: none;">
                            <div class="relative mb-3">
                                <x-label>Senior High</x-label>
                                {{-- <x-select name="SeniorHigh" > --}}
                                    <!-- Options for classrooms
                                    <x-input name="SeniorHigh" value="All" readonly>All Classroom</x-input>

                                    {{-- @foreach ($seniorHigh as $classHigh)
                                        <option value="{{ $classHigh->grade_level }}">Grade: {{ $classHigh->grade_level }}
                                            {{ $class->section }}</option>
                                    @endforeach --}}
                                {{-- </x-select>

                            </div>
                        </div>


                        <div class="w-full px-4">
                            <div class="relative mb-3">
                                <x-label for="section">School Year: <span class="text-green-500 text-sm">June(this
                                        year)-May(next-year)</span></x-label>
                                <x-select name="year" required>
                                    {{-- <option value="All">All Year</option>
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
    </script> --}}










//from the help controller
  <div x-data="{ currentGrid: 'totalStatusCases', buttonText: 'Total Case Status' }">
            <!-- Dropdown Component -->

            <div class="flex justify-end items-center space-x-2">
                <div id="dropdown">
                    <x-dropdown>
                        <x-slot name="trigger">
                            <div class="flex items-center cursor-pointer space-x-2">
                                <x-buttontype>
                                    <span id="selectedYear" class="flex items-center">
                                        {{ date('Y') }}-{{ date('Y') + 1 }}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1"> <!-- Adjust ml-1 (margin-left) to control the space between text and icon -->
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </x-buttontype>
                            </div>

                        </x-slot>
                        <x-slot name="content">
                            <ul id="yearFilter" class="mt-4">
                                <li class="py-2 px-2 cursor-pointer hover:text-green-500" data-year="All">All</li>
                                <li class="py-2 px-2 cursor-pointer hover:text-green-500" data-year="{{ date('Y') }}-{{ date('Y') + 1 }}">Current Year</li>
                                <li class="py-2 px-2 cursor-pointer hover:text-green-500" data-year="2021-2022">2021-2022</li>
                                <li class="py-2 px-2 cursor-pointer hover:text-green-500" data-year="2022-2023">2022-2023</li>
                                <li class="py-2 px-2 cursor-pointer hover:text-green-500" data-year="2023-2024">2023-2024</li>
                            </ul>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        <div class="container mx-auto">
            <canvas id="myPieChart" style="width:100%;max-width:600px"></canvas>
          </div>





          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
          <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function () {
                const xValuesPie = [];
                const yValuesPie = [];
                const barColorsPie = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797",
                    "#e8c3b9",
                    "#1e7145"
                ];

                // Create a reference to the chart instance
                let myPieChart;

                function updatePieChart(selectedYear) {
                    fetch(`/successfull-action?year=${selectedYear}`)
                        .then(response => response.json())
                        .then(data => {
                            xValuesPie.length = 0; // Clear the array
                            yValuesPie.length = 0; // Clear the array

                            data.forEach(item => {
                                xValuesPie.push(item.label);
                                yValuesPie.push(item.count);
                            });

                            // Check if the chart is already initialized
                            if (myPieChart) {
                                // Update the pie chart
                                myPieChart.data.labels = xValuesPie;
                                myPieChart.data.datasets[0].data = yValuesPie;
                                myPieChart.update();
                            } else {
                                // Initialize the pie chart
                                const ctx = document.getElementById('myPieChart').getContext('2d');
                                myPieChart = new Chart(ctx, {
                                    type: "pie",
                                    data: {
                                        labels: xValuesPie,
                                        datasets: [{
                                            backgroundColor: barColorsPie,
                                            data: yValuesPie
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: true,
                                            text: "Successful Offense"
                                        }
                                    }
                                });
                            }
                        })
                        .catch(error => console.error('Error fetching data:', error));
                }

                const yearFilter = document.getElementById('yearFilter');
                yearFilter.addEventListener('click', function (event) {
                    const selectedYear = event.target.dataset.year;
                    updatePieChart(selectedYear);
                });

                // Initial load
                updatePieChart('All');
            });
        </script>
