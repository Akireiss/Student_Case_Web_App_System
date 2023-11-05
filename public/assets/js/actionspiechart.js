function updateChart() {
    $.ajax({
        url: '/get-successful-actions', // Update this URL to match your route
        method: 'GET',
        success: function (data) {
            var labels = [];
            var dataCounts = [];
            var percentages = [];

            data.forEach(function (item) {
                labels.push(item.label); // Use 'item.label' as the label
                dataCounts.push(item.count);

                // Calculate the percentage and round it to two decimal places
                var percentage = ((item.count / data.reduce((acc, curr) => acc + curr.count, 0)) * 100).toFixed(2);
                percentages.push(percentage + '%');
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
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var count = data.datasets[0].data[tooltipItem.index];
                                var percentage = percentages[tooltipItem.index];
                                return label + ': ' + count + ' (' + percentage + ')';
                            }
                        }
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

// Uncomment this line to update the chart periodically (e.g., every 10 seconds)
// setInterval(updateChart, 10000);
