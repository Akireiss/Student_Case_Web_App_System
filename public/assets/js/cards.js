$(document).ready(function() {
    let timeRange = 'yearly';

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


    updateDashboardData(timeRange);

    // Set interval
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



//resolved cases

function updateResolvedCasesCount() {
    $.ajax({
        url: '/get-resolved-cases',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#resolved-cases-count').text(data.resolvedCount);
        },
        error: function() {
            console.log('Failed to fetch resolved cases count.');
        }
    });
}

// Update resolved cases count initially and every hour
updateResolvedCasesCount();
setInterval(updateResolvedCasesCount, 1000);


//Monthly
function updateMonthlyReportCount() {
    $.ajax({
        url: '/get-monthly-report-count',
        type: 'GET',
        success: function (data) {
            $('#monthly-report-count').text(data.monthlyReportCount);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Call the function initially to populate the count
updateMonthlyReportCount();

// Set up a timer to update the count periodically (e.g., every 30 seconds)
setInterval(updateMonthlyReportCount, 30000);
