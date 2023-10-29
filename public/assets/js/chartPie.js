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
                display: true,
             //   text: "Offense Counts"
            }
        }
    });
}
updateChartData();
