// Initial chart setup
const chartCanvas = document.getElementById("OffenseChart");
const ctx = chartCanvas.getContext("2d");
const barColors = [
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
    "#3377FF",
];

let chart; // Initialize the chart variable

// Function to create or update the chart
function createOrUpdateChart(xValuesOffense, yValuesOffense) {
    if (chart) {

        chart.data.labels = xValuesOffense;
        chart.data.datasets[0].data = yValuesOffense;
        chart.update(); // Update the existing chart
    } else {
        chart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: xValuesOffense,
                datasets: [
                    {
                        backgroundColor: barColors,
                        data: yValuesOffense,
                    },
                ],
            },
            options: {
                title: {
                    display: false,
                    text: " ",
                },
                tooltips: {
                    callbacks: {
                        label: (tooltipItem, data) => {
                            const dataset =
                                data.datasets[tooltipItem.datasetIndex];
                            const total = dataset.data.reduce(
                                (acc, value) => acc + value,
                                0
                            );
                            const currentValue =
                                dataset.data[tooltipItem.index];
                            const percentage =
                                ((currentValue / total) * 100).toFixed(2) + "%";
                            return `${
                                data.labels[tooltipItem.index]
                            }: ${currentValue} (${percentage})`;
                        },
                    },
                },
                legend: {
                    position: "bottom", // Align legend to the bottom
                },
            },
        });
    }
}





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

// Set the default value in the dropdown based on the current date
const defaultAcademicYear = calculateDefaultAcademicYear();
$('.py-2[data-year="' + defaultAcademicYear + '"]').addClass("text-green-400");

// Fetch data based on the default value
fetchData(defaultAcademicYear);

// Handle dropdown click event to fetch data
$(".py-2").click(function () {
    const selectedYear = $(this).data("year");
    $(".py-2").removeClass("text-green-400");
    $(this).addClass("text-green-400");
    fetchData(selectedYear);
});

function fetchData(selectedYear) {
    const url = `/get-offense-counts-new?year=${selectedYear}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            // Extract xValuesOffense and yValuesOffense from the fetched data
            const xValuesOffense = data.map((item) => item.offense);
            const yValuesOffense = data.map((item) => item.count);

            createOrUpdateChart(xValuesOffense, yValuesOffense);
        })
        .catch((error) =>
            console.error("Error fetching offense counts:", error)
        );
}
// Fetch data and update the chart
$(".py-2").click(function () {
    const selectedYear = $(this).data("year");
    const url = `/get-offense-counts-new?year=${selectedYear}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            // Extract xValuesOffense and yValuesOffense from the fetched data
            const xValuesOffense = data.map((item) => item.offense);
            const yValuesOffense = data.map((item) => item.count);

            createOrUpdateChart(xValuesOffense, yValuesOffense);
        })
        .catch((error) =>
            console.error("Error fetching offense counts:", error)
        );
});





// Other fybctuib stll eneed some adjustment
 // Gruop funcitons
    // / Fetch the data from the API
    // fetch('/get-offense-counts-new')
    // .then(response => response.json())
    // .then(data => {
    //     // Sort the data by count in descending order
    //     const sortedData = data.sort((a, b) => b.count - a.count);

    //     // Take the top 5 entries and calculate the sum of the rest
    //     const top5Data = sortedData.slice(0, 5);
    //     const restSum = sortedData.slice(5).reduce((acc, item) => acc + item.count, 0);

    //     // Create an "Others" entry for the rest
    //     const othersData = [{ offense: 'Others', count: restSum }];

    //     // Combine top 5 and "Others" data
    //     const combinedData = top5Data.concat(othersData);

    //     // Extract xValuesOffense and yValuesOffense from the combined data
    //     const xValuesOffense = combinedData.map(item => item.offense);
    //     const yValuesOffense = combinedData.map(item => item.count);

    //     // Calculate percentages
    //     const total = yValuesOffense.reduce((acc, count) => acc + count, 0);
    //     const percentages = yValuesOffense.map(count => ((count / total) * 100).toFixed(2) + '%');

    //     // Create a new Chart using the combined data and percentages
    //     new Chart("OffenseChart", {
    //         type: "pie",
    //         data: {
    //             labels: xValuesOffense,
    //             datasets: [{
    //                 backgroundColor: barColors.slice(0, xValuesOffense.length),
    //                 data: yValuesOffense
    //             }]
    //         },
    //         options: {
    //             title: {
    //                 display: false,
    //                 text: " "
    //             },
    //             tooltips: {
    //                 callbacks: {
    //                     label: (tooltipItem, data) => {
    //                         const dataset = data.datasets[tooltipItem.datasetIndex];
    //                         const total = dataset.data.reduce((acc, value) => acc + value, 0);
    //                         const currentValue = dataset.data[tooltipItem.index];
    //                         const percentage = ((currentValue / total) * 100).toFixed(2) + '%';
    //                         return `${data.labels[tooltipItem.index]}: ${currentValue} (${percentage})`;
    //                     }
    //                 }
    //             }
    //         }
    //     });
    // })
    // .catch(error => console.error('Error fetching offense counts:', error));















