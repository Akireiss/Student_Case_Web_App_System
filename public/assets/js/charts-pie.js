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
    const maxEntriesToShow = 5;

    // Take the top 5 entries
    const topXValues = xValuesOffense.slice(0, maxEntriesToShow);
    const topYValues = yValuesOffense.slice(0, maxEntriesToShow);

    // Calculate the sum of the rest
    const restXValues = ["Others"];
    const restYValues = [
        yValuesOffense
            .slice(maxEntriesToShow)
            .reduce((acc, val) => acc + val, 0),
    ];

    // Combine top 5 and "Others" data
    const combinedXValues = [...topXValues, ...restXValues];
    const combinedYValues = [...topYValues, ...restYValues];

    if (chart) {
        chart.data.labels = combinedXValues;
        chart.data.datasets[0].data = combinedYValues;
        chart.update(); // Update the existing chart
    } else {
        chart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: combinedXValues,
                datasets: [
                    {
                        backgroundColor: barColors,
                        data: combinedYValues,
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
                    position: "bottom",
                },
            },
        });
    }
}

function calculateDefaultAcademicYearOffense() {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const academicYearStartMonth = 5; // June (0-indexed)

    if (currentDate.getMonth() < academicYearStartMonth) {
        return `${currentYear - 1}-${currentYear}`;
    } else {
        return `${currentYear}-${currentYear + 1}`;
    }
}
const defaultAcademicYear = calculateDefaultAcademicYearOffense();
$("#number_offense_year").val(defaultAcademicYear).addClass("text-green-400");

fetchDataOffense(defaultAcademicYear);

$("#number_offense_year").change(function () {
    const selectedYear = $(this).val();
    $("#number_offense_year").removeClass("text-green-400");
    $(this).addClass("text-green-400");
    fetchDataOffense(selectedYear);
});

function fetchDataOffense(selectedYear) {
    const url = `/get-offense-counts-new?number_offense_year=${selectedYear}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const xValuesOffense = data.map((item) => item.offense);
            const yValuesOffense = data.map((item) => item.count);

            createOrUpdateChart(xValuesOffense, yValuesOffense);
        })
        .catch((error) =>
            console.error("Error fetching offense counts:", error)
        );
}
