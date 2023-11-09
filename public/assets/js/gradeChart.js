const groupedBarConfig = {
    type: 'bar',
    data: {
        labels: ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'],
        datasets: [
            {
                label: 'Pending',
                backgroundColor: '#0694a2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Ongoing',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Resolved',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Follow Up',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            },
            {
                label: 'Refferal',
                backgroundColor: '#7e3af2',
                borderWidth: 1,
                data: [],
            }
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: false,
        },
    },
};

// Create or update the chart
const groupedBarCtx = document.getElementById('TestBar');
const myGroupedBar = new Chart(groupedBarCtx, groupedBarConfig);

