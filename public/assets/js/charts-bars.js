// Define the Chart.js configuration
const barConfig = {
    type: 'bar',
    data: {
        labels: ['June', 'July', 'August', 'September', 'October', 'November', 'December',
         'January', 'February', 'March', 'April', 'May'],
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
                label: 'Refferal',
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

const barsCtx = document.getElementById('bar').getContext('2d');
const myBar = new Chart(barsCtx, barConfig);

// Function to update the chart
function updateChart(data, startMonth, endMonth) {
    const months = [
        'June', 'July', 'August', 'September', 'October', 'November', 'December',
        'January', 'February', 'March', 'April', 'May'
    ];

    // Find the indices of the start and end months
    const startIndex = months.indexOf(startMonth);
    const endIndex = months.indexOf(endMonth);

    // Update the chart data for the specified range of months
    for (let i = 0; i < months.length; i++) {
        if (i >= startIndex && i <= endIndex) {
            const month = months[i];
            barConfig.data.datasets[0].data[i] = data.pending[month] || 0;
            barConfig.data.datasets[1].data[i] = data.ongoing[month] || 0;
            barConfig.data.datasets[2].data[i] = data.resolved[month] || 0;
            barConfig.data.datasets[3].data[i] = data.followup[month] || 0;
            barConfig.data.datasets[4].data[i] = data.refferal[month] || 0;
        } else {
            // Set data to 0 for months outside the selected range
            barConfig.data.datasets[0].data[i] = 0;
            barConfig.data.datasets[1].data[i] = 0;
            barConfig.data.datasets[2].data[i] = 0;
            barConfig.data.datasets[3].data[i] = 0;
            barConfig.data.datasets[4].data[i] = 0;
        }
    }

    myBar.update();
}
// Define the function to get the current academic year
function getCurrentAcademicYear() {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const academicYearStartMonth = 5; // June (0-indexed)

    if (currentDate.getMonth() >= academicYearStartMonth) {
        // If the current month is in or after June, set the academic year as the current year to the next year
        return `${currentYear}-${currentYear + 1}`;
    } else {
        // Otherwise, set the academic year as the previous year to the current year
        return `${currentYear - 1}-${currentYear}`;
    }
}

// Function to handle dropdown change event
$('#case_year').change(function () {
    const selectedYear = $(this).val();
    let startMonth = 'June';
    let endMonth = 'May';

    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    if (selectedYear === 'Current Year') {
        if (currentMonth < 5) {
            // If the current month is before June, set the academic year to the previous year's June to May
            startMonth = 'June';
            endMonth = 'May';
        }
    } else if (selectedYear === 'All') {
        // For 'All', keep the default start and end months (June to May)
        startMonth = 'June';
        endMonth = 'May';
    } else {
        const years = selectedYear.split('-');
        const startYear = parseInt(years[0]);
        const endYear = parseInt(years[1]);

        if (currentYear === startYear) {
            startMonth = 'June';
            if (endMonth !== 'May' && endYear === currentYear + 1) {
                endMonth = 'May';
            }
        } else if (endYear === currentYear) {
            if (endMonth !== 'May') {
                endMonth = 'May';
            }
        }
    }

    fetchData(selectedYear, startMonth, endMonth);
});

// Function to fetch data
function fetchData(selectedYear, startMonth, endMonth) {
    const url = '/admin/get-case-counts?case_year=' + selectedYear;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            updateChart(data, startMonth, endMonth);
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });
}

// ...

// Set the default value in the dropdown
$(document).ready(function () {
    $('#case_year').val(getCurrentAcademicYear());

    // Fetch data for the default year (current academic year) with June to May range
    fetchData(getCurrentAcademicYear(), 'June', 'May');
});
