function updateChart() {
    $.ajax({
        url: '/get-successful-actions',
        method: 'GET',
        success: function (data) {
            var labels = [];
            var dataCounts = [];
            var percentages = [];

            data.forEach(function (item) {
                labels.push(item.label);
                dataCounts.push(item.count);


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
                        display: false,
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
                    legend: {
                        position: "bottom",
                    },
                },
            });
        },
        error: function (error) {
            console.error(error);
        },
    });
}


updateChart();

