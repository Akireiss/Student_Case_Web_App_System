// Define your labels as you did in your code
var labels = [7, 8, 9, 10, 11, 12];

// Create the Chart.js chart with initial empty data
var myGroupedBar = new Chart("myGroupedBar", {
    type: "bar",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Pending",
                backgroundColor: "red",
                data: [],
            },
            {
                label: "Ongoing",
                backgroundColor: "green",
                data: [],
            },
            {
                label: "Resolved",
                backgroundColor: "blue",
                data: [],
            },
            {
                label: "FollowUp",
                backgroundColor: "yellow",
                data: [],
            },
            {
                label: "Referral",
                backgroundColor: "orange",
                data: [],
            },
        ],
    },
    options: {
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true,
            },
        },
        title: {
            display: false,
            text: "Grouped Bar Chart",
        },
    },
});

// Function to fetch data and update the chart
function fetchData() {
    $.ajax({
        url: '/get-chart-data', // Update with your endpoint
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Assuming your data is structured like { grade_level: { case_status: count, ... }, ... }
            // You can modify this to match your data structure
            // Example: { "Grade 7": { "Pending": 5, "Ongoing": 10, ... }, ... }

            // Use your existing labels to map to the database grade_levels
            const gradeLevelsMap = {
                7: "Grade 7",
                8: "Grade 8",
                9: "Grade 9",
                10: "Grade 10",
                11: "Grade 11",
                12: "Grade 12",
            };

            // Initialize arrays to store counts for each case_status
            const pendingData = [];
            const ongoingData = [];
            const resolvedData = [];
            const followUpData = [];
            const referralData = [];

            // Iterate over your labels and populate the arrays
            labels.forEach((label) => {
                const gradeLevel = gradeLevelsMap[label];
                const gradeData = data[gradeLevel];
                pendingData.push(gradeData["Pending"] || 0);
                ongoingData.push(gradeData["Ongoing"] || 0);
                resolvedData.push(gradeData["Resolved"] || 0);
                followUpData.push(gradeData["FollowUp"] || 0);
                referralData.push(gradeData["Referral"] || 0);
            });

            // Update the chart data
            myGroupedBar.data.datasets[0].data = pendingData;
            myGroupedBar.data.datasets[1].data = ongoingData;
            myGroupedBar.data.datasets[2].data = resolvedData;
            myGroupedBar.data.datasets[3].data = followUpData;
            myGroupedBar.data.datasets[4].data = referralData;

            myGroupedBar.update();

            // Schedule the next data fetch
            setTimeout(fetchData, 3000); // Fetch data every 3 seconds
        },
        error: function (error) {
            console.error('Error fetching data:', error);
            // Retry fetching data in case of an error
            setTimeout(fetchData, 3000); // Retry fetching data every 3 seconds
        }
    });
}

// Initialize the chart and start fetching data
window.onload = function () {
    fetchData();
};
