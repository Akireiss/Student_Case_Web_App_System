
const xValuesOffense = ["Italy", "France", "Spain", "USA", "Argentina"];
const yValuesOffense = [55, 49, 44, 24, 15];
const barColors = [
"#b91d47",
"#00aba9",
"#2b5797",
"#e8c3b9",
"#1e7145"
];

new Chart("OffenseChart", {
type: "pie",
data: {
labels: xValuesOffense,
datasets: [{
  backgroundColor: barColors,
  data: yValuesOffense
}]
},
options: {
title: {
  display: false,
  text: " "
}
}
});
