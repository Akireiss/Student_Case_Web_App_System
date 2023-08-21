const barConfig = {
    type: 'bar',
    data: {
        labels: ['August', 'September', 'October', 'November', 'December'],
        datasets: [
            {
                label: 'Pending',
                backgroundColor: '#0694a2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Resolved',
                backgroundColor: '#7e3af2',
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

const barsCtx = document.getElementById('bars').getContext('2d');
const myBar = new Chart(barsCtx, barConfig);

function updateChart(data) {
    const months = ['August', 'September', 'October', 'November', 'December'];

    for (let i = 0; i < months.length; i++) {
        const month = months[i];
        barConfig.data.datasets[0].data[i] = data.pending[month] || 0;
        barConfig.data.datasets[1].data[i] = data.resolved[month] || 0;
    }

    myBar.update();
}

function fetchData() {
    $.ajax({
        url: '/admin/get-case-counts', // Update with your endpoint
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            updateChart(data);
            setTimeout(fetchData, 1000); // Fetch data every second
        },
        error: function (error) {
            console.error('Error fetching data:', error);
            setTimeout(fetchData, 1000); // Retry fetching data every second
        }
    });
}

fetchData();
