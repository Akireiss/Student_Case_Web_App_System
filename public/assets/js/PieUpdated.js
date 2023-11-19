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
                            },
                            legend: {
                                position: "bottom", // Align legend to the bottom
                            },
                        },
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
