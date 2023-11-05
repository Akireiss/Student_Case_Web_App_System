let xValues = []; // Labels
let yValues = []; // Counts

// Define fixed colors for the first 15 offenses
const fixedColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#1e7145",
    "#FF5733",
    "#33FF57",
    "#5733FF",
    "#FF33AA",
    "#33AAFF",
    "#FFAA33",
    "#33FFAA",
    "#AA33FF",
    "#FF3377",
    "#3377FF"
];

function updateChartData() {
    $.ajax({
        url: '/get-offense-counts', // Replace with your route URL
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            xValues = data.map(entry => entry.offense);
            yValues = data.map(entry => entry.count);
            updatePieChart();
        },
        error: function () {
            console.log('Failed to fetch offense counts.');
        }
    });
}

function updatePieChart() {
    const barColors = fixedColors.slice(0, xValues.length); // Use fixed colors for the offenses

    new Chart("myChartPie", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: false,
                text: "Offense Counts"
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[0];
                        var total = dataset.data.reduce(function (previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5); // Round to the nearest integer
                        return xValues[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        // Adjust the alignment and rotation of the labels
                        align: 'start', // 'start', 'end', 'center'
                        // Rotate labels by 45 degrees (adjust the angle as needed)
                        usePointStyle: true,
                        boxWidth: 10,
                    }
                }
            }

        }
    });
}

updateChartData();
