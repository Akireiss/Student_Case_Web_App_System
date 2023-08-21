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
        },
        error: function() {
            console.log('Failed to fetch dashboard data.');
        }
    });
}
setInterval(updateDashboardData, 1000);
