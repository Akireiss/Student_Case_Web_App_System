const barConfigGrade = {
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

const barsCtxGrade = document.getElementById('barGradeLevel').getContext('2d');
const myBarGrade = new Chart(barsCtxGrade, barConfigGrade);

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
            myBarGrade.data.labels = labels;
            myBarGrade.data.datasets.forEach((dataset, index) => {
                dataset.data = datasets[index];
            });

            // Update the chart
            myBarGrade.update();
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
