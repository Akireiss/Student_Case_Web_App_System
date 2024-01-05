

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
