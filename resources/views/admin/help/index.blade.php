@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h6 class="text-left text-2xl text-black ">
            Guide Area
        </h6>



    <x-grid columns="2" gap="4" px="0" mt="0">
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




    </x-grid>
    </div>


<script src="{{ asset('assets/js/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>

<script>
const barConfig = {
    type: 'bar',
    data: {
        labels: [],
        datasets: [
            {
                label: 'Pending',
                backgroundColor: 'red',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Ongoing',
                backgroundColor: '#F2FF47',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Resolved',
                backgroundColor: '#02BF0B',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Follow Up',
                backgroundColor: '#0A81E7',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Referral',
                backgroundColor: '#FFC300',
                borderWidth: 1,
                data: [],
            },
        ],
    },
    options: {
        responsive: true,
        legend: {
            display: true,
        },
    },
};

const barsCtx = document.getElementById('barGradeLevel').getContext('2d');
const myBar = new Chart(barsCtx, barConfig);

function calculateDefaultAcademicYear() {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const academicYearStartMonth = 5; // June (0-indexed)

    if (currentDate.getMonth() < academicYearStartMonth) {
        // If the current month is before June, set the academic year as the previous year to the current year
        return `${currentYear - 1}-${currentYear}`;
    } else {
        // Otherwise, set the academic year as the current year to the next year
        return `${currentYear}-${currentYear + 1}`;
    }
}

function fetchAndLoadData(selectedYear) {
    const url = `/get-barchart-data?year=${selectedYear}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const labels = data.map(item => item.grade_level);
            const datasets = [data.map(item => item.pending), data.map(item => item.ongoing), data.map(item => item.resolved), data.map(item => item.follow_up), data.map(item => item.referral)];

            // Update the Chart.js data with the fetched data
            myBar.data.labels = labels;
            myBar.data.datasets.forEach((dataset, index) => {
                dataset.data = datasets[index];
            });

            // Update the chart
            myBar.update();
        })
        .catch((error) =>
            console.error("Error fetching data:", error)
        );
}

function initializeDropdown() {
    // Set the default value in the dropdown based on the current date
    const defaultAcademicYear = calculateDefaultAcademicYear();
    $('.py-2[data-year="' + defaultAcademicYear + '"]').addClass("text-green-400");

    // Fetch data based on the default value
    fetchAndLoadData(defaultAcademicYear);

    // Handle dropdown click event to fetch data
    $(".py-2").click(function () {
        const selectedYear = $(this).data("year");
        $(".py-2").removeClass("text-green-400");
        $(this).addClass("text-green-400");
        fetchAndLoadData(selectedYear);
    });
}

// Initialize the chart and dropdown
initializeDropdown();

</script>



@endsection
