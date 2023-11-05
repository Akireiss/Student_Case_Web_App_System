const groupedBarConfig = {
    type: 'bar',
    data: {
        labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'],
        datasets: [
            {
                label: 'Pending',
                backgroundColor: '#0694a2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Ongoing',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Resolved',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Follow Up',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Refferal',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            }
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
    },
};

// Create or update the chart
const groupedBarCtx = document.getElementById('myGroupedBarChart');
const myGroupedBar = new Chart(groupedBarCtx, groupedBarConfig);

function fetchChartData() {
    // Fetch the data from your Laravel backend endpoint
    $.ajax({
        url: '/get-chart-data', // Replace with your actual route
        method: 'GET',
        // Update the chart data with the fetched data
        success: function (datas) {
        for (let i = 0; i < groupedBarConfig.data.labels.length; i++) {
                const gradeLevel = groupedBarConfig.data.labels[i];
                groupedBarConfig.data.datasets[1].data[i] = datas.ongoing[gradeLevel] || 0;
                groupedBarConfig.data.datasets[0].data[i] = datas.pending[gradeLevel] || 0;
                groupedBarConfig.data.datasets[2].data[i] = datas.resolved[gradeLevel] || 0;
                groupedBarConfig.data.datasets[3].data[i] = datas.followup[gradeLevel] || 0;
                groupedBarConfig.data.datasets[4].data[i] = datas.refferal[gradeLevel] || 0;
            }

            [gradeLevel]

            myGroupedBar.update();
        },
        error: function (error) {
            console.error('Error fetching chart data:', error);
        }
    });
}

// Call the fetchChartData function to load the initial data
fetchChartData();
