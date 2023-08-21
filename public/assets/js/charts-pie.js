/**
 * For usage, visit Chart.js docs https://www.chartjs.org/docs/latest/
 */
const pieConfig = {
  type: 'doughnut',
  data: {
    datasets: [
      {
        data: [33, 33, 33],
        backgroundColor: [],
        label: 'Dataset 1',
      },
    ],
    labels: [],
  },
  options: {
    responsive: true,
    cutoutPercentage: 80,
    legend: {
      display: false,
    },
  },
}

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}


function updatePieChart() {
    $.ajax({
        url: '/get-offense-counts',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            const offenses = data.map(entry => entry.offense);
            const counts = data.map(entry => entry.count);

            const backgroundColors = offenses.map(() => getRandomColor());

            pieConfig.data.datasets[0].data = counts;
            pieConfig.data.labels = offenses;
            pieConfig.data.datasets[0].backgroundColor = backgroundColors;

            myPie.update();
        },
        error: function() {
            console.log('Failed to fetch offense counts.');
        }
    });
}

// Call the function to update the pie chart initially and set an interval to update it periodically
updatePieChart();
setInterval(updatePieChart, 60000); // Update every minute


const pieCtx = document.getElementById('pie')
window.myPie = new Chart(pieCtx, pieConfig)
