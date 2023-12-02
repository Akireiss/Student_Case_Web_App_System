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
    const url = `/get-barchart-data?level_offense_year=${selectedYear}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const labels = data.map(item => item.grade_level);
            const datasets = [
                {
                    label: 'Pending',
                    backgroundColor: 'red',
                    borderWidth: 1,
                    data: data.map(item => item.pending),
                },
                {
                    label: 'Ongoing',
                    backgroundColor: '#F2FF47',
                    borderWidth: 1,
                    data: data.map(item => item.ongoing),
                },
                {
                    label: 'Resolved',
                    backgroundColor: '#02BF0B',
                    borderWidth: 1,
                    data: data.map(item => item.resolved),
                },
                {
                    label: 'Follow Up',
                    backgroundColor: '#0A81E7',
                    borderWidth: 1,
                    data: data.map(item => item.follow_up),
                },
                {
                    label: 'Referral',
                    backgroundColor: '#FFC300',
                    borderWidth: 1,
                    data: data.map(item => item.referral),
                },
            ];

            // Update the Chart.js data with the fetched data
            myBarGrade.data.labels = labels;
            myBarGrade.data.datasets = datasets;

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
    $('#level_offense_year option[value="' + defaultAcademicYear + '"]').prop('selected', true);

    // Fetch data based on the default value
    fetchAndLoadData(defaultAcademicYear);

    // Handle dropdown change event to fetch data
    $("#level_offense_year").change(function () {
        const selectedYear = $(this).val();
        fetchAndLoadData(selectedYear);
    });
}

// Initialize the chart and dropdown
initializeDropdown();
