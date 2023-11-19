@extends('layouts.dashboard.index')

@section('content')
    <div>

        <h6 class="text-left text-2xl text-black ">
            Guide Area
        </h6>
        <h6 class="text-sm my-1 px-4 font-bold uppercase mt-3">
            Ongoing...
        </h6>

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
@endsection
