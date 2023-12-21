$(document).ready(function() {
    function updateDashboardData() {
        $.ajax({
            url: '/get-dashboard-data',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#total-students').text(data.totalStudents);
                $('#total-cases').text(data.totalCases);
                $('#pending-cases').text(data.pendingCases);
                $('#resolved-cases').text(data.resolvedCases);
                $('#ongoingCases').text(data.ongoingCases);
                $('#total-male').text(data.totalMale);
                $('#total-female').text(data.totalFemale);
                $('#maleCases').text(data.maleCases);
                $('#femaleCases').text(data.femaleCases);
            },
            error: function() {
                console.log('Failed to fetch dashboard data.');
            }
        });
    }
    updateDashboardData();
});


function showAlert(alertId) {
    $('#' + alertId).removeClass('hidden-alert-weekly');
}

function hideAlert(alertId) {
    $('#' + alertId).addClass('hidden-alert-weekly');
}

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

updateResolvedCasesCount();

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

updateMonthlyReportCount();
