document.addEventListener('DOMContentLoaded', function () {
    const xValuesPie = [];
    const yValuesPie = [];
    const barColorsPie = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    let myPieChart;

    function updatePieChart(selectedYear) {
        fetch(`/successfull-action?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                xValuesPie.length = 0;
                yValuesPie.length = 0;

                data.forEach(item => {
                    xValuesPie.push(item.label);
                    yValuesPie.push(item.count);
                });

                if (myPieChart) {
                    myPieChart.data.labels = xValuesPie;
                    myPieChart.data.datasets[0].data = yValuesPie;
                    myPieChart.update();
                } else {
                    const ctx = document.getElementById('myPieChart').getContext('2d');
                    myPieChart = new Chart(ctx, {
                        type: "pie",
                        data: {
                            labels: xValuesPie,
                            datasets: [{
                                backgroundColor: barColorsPie,
                                data: yValuesPie
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                                text: "Successful Offense"
                            },
                            legend: {
                                position: "bottom",
                            },
                            tooltips: {
                                callbacks: {
                                    label: function (tooltipItem, data) {
                                        const dataset = data.datasets[tooltipItem.datasetIndex];
                                        const total = dataset.data.reduce((previousValue, currentValue, currentIndex, array) => {
                                            return previousValue + currentValue;
                                        });
                                        const currentValue = dataset.data[tooltipItem.index];
                                        const percentage = Math.round((currentValue / total) * 100);
                                        return `${data.labels[tooltipItem.index]}: ${currentValue} (${percentage}%)`;
                                    }
                                }
                            }
                        },
                    });
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    const yearFilter = document.getElementById('yearFilter');
    yearFilter.addEventListener('click', function (event) {
        const selectedYear = event.target.dataset.year;
        updatePieChart(selectedYear);
    });

    // Initial load
    updatePieChart('All');
});
