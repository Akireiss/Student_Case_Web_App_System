document.addEventListener("DOMContentLoaded", function() {
    var selectYear = document.getElementById("level_offense_year");
    var selectClassroom = document.getElementById("classroom_chart_year");
    var barGradeLevel = document.getElementById("barGradeLevel");
    var barClassroom = document.getElementById("barClassroom");

    var initialDisplay = barGradeLevel.style.display;

    selectClassroom.addEventListener("change", function() {
        var selectedIndex = selectClassroom.selectedIndex;

        if (selectedIndex === 0) {
            barGradeLevel.style.display = initialDisplay;
            barClassroom.style.display = "none";
            selectYear.disabled = false;
        } else if (selectClassroom.value === "All") {
            barGradeLevel.style.display = initialDisplay;
            barClassroom.style.display = "none";
            selectYear.disabled = true;
        } else {
            barGradeLevel.style.display = "none";
            barClassroom.style.display = "block";
            selectYear.disabled = true;
        }
    });

    selectClassroom.dispatchEvent(new Event("change"));
});

document.addEventListener('DOMContentLoaded', function() {
    var levelOffenseYearSelect = document.getElementById('level_offense_year');
    var classroomChartYearSelect = document.getElementById('classroom_chart_year');

    levelOffenseYearSelect.addEventListener('change', function() {
        var isAllSelected = levelOffenseYearSelect.value === 'All';

        classroomChartYearSelect.disabled = isAllSelected;
    });
});
