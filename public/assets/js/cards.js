$(document).ready(function() {
    let timeRange = 'yearly'; // Initially set to 'yearly'

    $('#toggle-time-range').click(function() {
        timeRange = (timeRange === 'all') ? 'yearly' : 'all';
        updateDashboardData(timeRange);
    });

    function updateDashboardData(timeRange) {
        $.ajax({
            url: '/get-dashboard-data',
            method: 'GET',
            data: { time_range: timeRange },
            dataType: 'json',
            success: function(data) {
                $('#total-students').text(data.totalStudents);
                $('#total-cases').text(data.totalCases);
                $('#pending-cases').text(data.pendingCases);
                $('#resolved-cases').text(data.resolvedCases);
            },
            error: function() {
                console.log('Failed to fetch dashboard data.');
            }
        });
    }

    // Initially load data for the current year
    updateDashboardData(timeRange);

    // Set interval to update data periodically
    setInterval(function() {
        updateDashboardData(timeRange);
    }, 1000);
});
//Weekly Alert
function showAlert(alertId) {
    $('#' + alertId).removeClass('hidden-alert-weekly');
}

// Function to hide the alert
function hideAlert(alertId) {
    $('#' + alertId).addClass('hidden-alert-weekly');
}

function updateWeeklyReportCount() {
    $.ajax({
        url: '/get-weekly-report-count',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#weekly-report-count').text(data.weeklyReportCount);
            if (data.weeklyReportCount === 0) {
                $('#weekly-alert').removeClass('bg-red-500').addClass('bg-green-500');
            } else {
                $('#weekly-alert').removeClass('bg-green-500').addClass('bg-red-400');
            }
        },
        error: function() {
            console.log('Failed to fetch weekly report count.');
        }
    });
}

// Update every 1 hour (3600000 milliseconds)
setInterval(updateWeeklyReportCount, 1000);




//Montly Alert
function showAlert() {
    $('#monthly-alert').removeClass('hidden-alert');
}

// Function to hide the alert
function hideAlert() {
    $('#monthly-alert').addClass('hidden-alert');
}

// Update monthly report count every hour
function updateMonthlyReportCount() {
    $.ajax({
        url: '/get-monthly-report-count',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#monthly-report-count').text(data.monthlyReportCount);
        },
        error: function() {
            console.log('Failed to fetch monthly report count.');
        }
    });
}

// Show the alert only during the first 3 days of each month
const currentDate = new Date();
const currentDay = currentDate.getDate();

if (currentDay <= 3) {
    setTimeout(showAlert, (4 - currentDay) * 24 * 3600000);
    setInterval(updateMonthlyReportCount, 3600000);
} else {
    hideAlert();
    updateMonthlyReportCount();
}
