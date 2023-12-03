$(document).ready(function () {
    $("#level_offense_year").change(function () {
        const selectedYear = $(this).val();

        $("#classroom_chart_year").empty();
        $("#classroom_chart_year").append(
            "<option selected>Select Classroom</option>"
        );

        fetchClassroomData(selectedYear);
    });

    $("#classroom_chart_year").change(function () {
        const selectedGradeLevel = $(this).val();
        const selectedYear = $("#level_offense_year").val();

        fetchAnecdotalData(selectedYear, selectedGradeLevel);
    });

    const defaultAcademicYear = $("#level_offense_year").val();
    fetchClassroomData(defaultAcademicYear);
});

function fetchClassroomData(selectedYear) {
    $.ajax({
        url: "/get-classroom-data",
        type: "GET",
        data: { level_offense_year: selectedYear },
        dataType: "json",
        success: function (data) {
            if (data && data.classrooms) {
                populateClassroomDropdown(data.classrooms);
            } else {
                console.error("Invalid data format:", data);
            }
        },
        error: function (error) {
            console.error("Error fetching classroom data:", error);
        },
    });
}

function populateClassroomDropdown(data) {
    $("#classroom_chart_year").empty();
    $("#classroom_chart_year").append("<option selected>Select Classroom</option>");

    data.forEach((gradeLevel) => {
        const option = `<option value="${gradeLevel}">${gradeLevel}</option>`;
        $("#classroom_chart_year").append(option);
    });
}

var xValuesClassroom = ["Pending", "Ongoing", "Resolved", "Follow Up", "Referral"];
var yValuesClassroom = [];
var barColorsClassroom = ["red", "green", "blue", "orange", "black"];

var myChartClassroom = new Chart("myChartClassroom", {
    type: "bar",
    data: {
        labels: xValuesClassroom,
        datasets: [
            {
                backgroundColor: barColorsClassroom,
                data: yValuesClassroom,
            },
        ],
    },
    options: {
        legend: { display: false },
        title: {
            display: false,
            text: "",
        },
    },
});

function fetchAnecdotalData(selectedYear, selectedGradeLevel) {
    $.ajax({
        url: "/get-classroom-anecdotal-data",
        type: "GET",
        data: { level_offense_year: selectedYear, selected_grade_level: selectedGradeLevel },
        dataType: "json",
        success: function (data) {
            if (data && data.anecdotalData) {
                updateBarChart(data.anecdotalData);
            } else {
                console.error("Invalid data format:", data);
            }
        },
        error: function (error) {
            console.error("Error fetching anecdotal data:", error);
        },
    });
}

function updateBarChart(anecdotalData) {
    const yValuesClassroom = Object.values(anecdotalData);

    myChartClassroom.data.datasets[0].data = yValuesClassroom;

    myChartClassroom.update();
}
