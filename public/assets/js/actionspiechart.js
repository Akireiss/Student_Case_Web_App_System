function updateChart() {
    $.ajax({
        url: '/get-successful-actions', // Update this URL to match your route
        method: 'GET',
        success: function (data) {
            var labels = [];
            var dataCounts = [];

            data.forEach(function (item) {
                labels.push(item.actions);
                dataCounts.push(item.count);
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Successful Actions',
                        backgroundColor: ['#3e95cd', '#8e5ea2', '#3cba9f', '#e8c3b9', '#c45850'],
                        data: dataCounts,
                    }],
                },
                options: {
                    title: {
                        display: true,
                        text: 'Successful Actions',
                    },
                },
            });
        },
        error: function (error) {
            console.error(error);
        },
    });
}

// Initial chart rendering
updateChart();


setInterval(updateChart, 10000);
