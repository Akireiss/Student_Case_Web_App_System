
var xValuesClassroom = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValuesClassroom = [55, 49, 44, 24, 15];
var barColorsClassroom = ["red", "green","blue","orange","brown"];

new Chart("myChartClassroom", {
  type: "bar",
  data: {
    labels: xValuesClassroom,
    datasets: [{
      backgroundColor: barColorsClassroom,
      data: yValuesClassroom
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});
