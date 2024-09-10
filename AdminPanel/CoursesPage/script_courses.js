document.addEventListener('DOMContentLoaded', function () {
    // Your function call here
    cancelButtonClicked();
});

function sendSelectedCourse() {
    if (selectedCourseId) {
        fetch('php/course_schedule.php?courseId=' + encodeURIComponent(selectedCourseId))
            .then(response => response.json())
            .then(data => {
                // Handle the response
                console.log('Course schedule data:', data);
            })
            .catch(error => {
                console.error('Error fetching course schedule:', error);
            });
    } else {
        console.warn('No course selected');
    }

}



function editCourseInfo(course_id) {

    var courseID = document.getElementById("course_id");
    var courseName = document.getElementById("courseName");
    var courseField = document.getElementById("fieldOfStudy");


    if (course_id) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "php/fetch_course_info.php?course_id=" + encodeURIComponent(course_id), true);
        xhr.send();

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    courseID.value = response.course_id;
                    courseName.value = response.course_name;
                    courseField.value = response.field_of_study;


                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    console.log("Response text:", xhr.responseText);
                }
            } else {
                console.error("Request failed. Status:", xhr.status);
            }
        };

    }

    editCourseSchedule(course_id);


}
function editCourseSchedule(course_id) {
    var scheduleTable = document.getElementById("schedule-table");

    if (!scheduleTable.tHead) {
        var thead = scheduleTable.createTHead();
        var headerRow = thead.insertRow();
        headerRow.innerHTML = "<th>Select</th><th>Day</th><th>Start Time</th><th>End Time</th>";
    }
    if (!scheduleTable.tBodies.length) {
        scheduleTable.createTBody();
    }

    if (course_id) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "php/fetch_course_schedule.php?course_id=" + encodeURIComponent(course_id), true);
        xhr.send();

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    var schedules = JSON.parse(xhr.responseText);
                    scheduleTable.tBodies[0].innerHTML = "";

                    if (Array.isArray(schedules) && schedules.length > 0) {
                        schedules.forEach(function (schedule) {
                            var row = scheduleTable.tBodies[0].insertRow();
                            row.innerHTML =
                                "<td><input type='radio' name='scheduleSelect' value='" + schedule.schedule_id + "'></td>" +
                                "<td>" + schedule.day_name + "</td>" +
                                "<td>" + schedule.start_time + "</td>" +
                                "<td>" + schedule.end_time + "</td>";
                        });
                    } else {
                        scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='4'>No schedule data available</td></tr>";
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='4'>Error loading schedule data</td></tr>";
                }
            } else {
                console.error("Request failed. Status:", xhr.status);
                scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='4'>Failed to load schedule data</td></tr>";
            }
        };
    }
}

function editButtonClicked() {
    var editSection = document.getElementById("edit-section");
    var contentSection = document.getElementById("content-section");
    var selectedButton = contentSection.querySelector('table tbody tr td:first-child input[type="radio"]:checked');

    if (selectedButton) {
        editSection.style.display = "flex";
        contentSection.style.display = "none";
    } else {
        alert("Please select a course to edit");
    }
}

function deleteButtonClicked() {
    var coursesTable = document.getElementById('courses-table');
    var selectedButton = coursesTable.querySelector('tbody tr td:first-child input[type="radio"]:checked');
    if (selectedButton) {
        var courseId = selectedButton.value;
        if (confirm("Are you sure you want to delete this course?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/delete_course.php?course_id=" + encodeURIComponent(courseId), true);
            xhr.send();

            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Course deleted successfully");
                    location.reload();
                } else {
                    alert("Error deleting course. Please try again.");
                }
            };
        }
    }
    else {
        alert("Please select a course to delete");
    }
}


function add_temp_clicked() {
    var dayId = document.getElementById("dayId").value;
    var startTime = document.getElementById("startTime").value;
    var finishTime = document.getElementById("finishTime").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/add_temp_schedule.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Class added successfully");
            load_schedule_add();
        } else {
            alert("Error adding class. Please try again.");
        }
    };
    xhr.send("dayId=" + encodeURIComponent(dayId) + "&startTime=" + encodeURIComponent(startTime) + "&finishTime=" + encodeURIComponent(finishTime));

}

function load_schedule_add() {
    var scheduleTable = document.getElementById("to-be-added-table");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/load_temp_schedule_add.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var schedules = JSON.parse(xhr.responseText);
                scheduleTable.tBodies[0].innerHTML = "";

                if (Array.isArray(schedules) && schedules.length > 0) {
                    schedules.forEach(function (schedule) {
                        var row = scheduleTable.tBodies[0].insertRow();
                        row.innerHTML =
                            "<td>" + schedule.day_name + "</td>" +
                            "<td>" + schedule.start_time + "</td>" +
                            "<td>" + schedule.end_time + "</td>";
                    });
                } else {
                    scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>No schedule data available</td></tr>";
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Error loading schedule data</td></tr>";
            }
        } else {
            console.error("Request failed. Status:", xhr.status);
            scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Failed to load schedule data</td></tr>";
        }
    };
    xhr.send();
}

function load_schedule_delete() {
    var scheduleTable = document.getElementById("to-be-removed");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/load_temp_schedule_remove.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var schedules = JSON.parse(xhr.responseText);
                scheduleTable.tBodies[0].innerHTML = "";

                if (Array.isArray(schedules) && schedules.length > 0) {
                    schedules.forEach(function (schedule) {
                        var row = scheduleTable.tBodies[0].insertRow();
                        row.innerHTML =
                            "<td>" + schedule.day_name + "</td>" +
                            "<td>" + schedule.start_time + "</td>" +
                            "<td>" + schedule.end_time + "</td>";
                    });
                } else {
                    scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>No schedule data available</td></tr>";
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Error loading schedule data</td></tr>";
            }
        } else {
            console.error("Request failed. Status:", xhr.status);
            scheduleTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Failed to load schedule data</td></tr>";
        }
    };
    xhr.send();
}

function remove_temp_clicked() {
    var scheduleTable = document.getElementById("schedule-table");
    if (!scheduleTable) {
        console.error("Schedule table not found");
        return;
    }

    var selectedRadio = scheduleTable.querySelector('tbody tr td:first-child input[type="radio"]:checked');
    if (selectedRadio) {
        const scheduleId = selectedRadio.value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "php/remove_temp_schedule.php?schedule_id=" + encodeURIComponent(scheduleId), true);
        xhr.send();
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert("Class added successfully");
                load_schedule_delete();
            } else {
                alert("Error adding class. Please try again.");
            }
        };
    } else {
        console.log("No radio button selected");
    }
}


function cancelButtonClicked() {
    var editSection = document.getElementById("edit-section");
    var contentSection = document.getElementById("content-section");
    var courseID = document.getElementById("course_id");
    var courseName = document.getElementById("courseName");
    var courseField = document.getElementById("fieldOfStudy");
    var coursesTable = document.getElementById('courses-table');
    var selectedButton = coursesTable.querySelector('tbody tr td:first-child input[type="radio"]:checked');


    editSection.style.display = "none";
    contentSection.style.display = "flex";

    courseID.value = "";
    courseName.value = "";
    courseField.value = "";

    if (selectedButton) {
        selectedButton.checked = false;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/reset_editing.php", true);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("Reset editing successfully");
            load_schedule_add();
            load_schedule_delete();
        }
        else {
            alert("Error resetting editing. Please try again.");
        }


    }
}
function saveButtonClicked() {
    var courseId = document.getElementById("course_id").value;
    var courseName = document.getElementById("courseName").value;
    var courseField = document.getElementById("fieldOfStudy").value;


    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/save_editing.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("courseName=" + encodeURIComponent(courseName) + "&courseField=" + encodeURIComponent(courseField) + "&courseId=" + encodeURIComponent(courseId));

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert("Editing saved successfully");
            load_schedule_add();
            load_schedule_delete();
        }
        else {
            alert("Error saving editing. Please try again.");
        }
    }

}

function createButtonClicked() {
    cancelButtonClicked();


    var editSection = document.getElementById("edit-section");
    var contentSection = document.getElementById("content-section");
    var courseID = document.getElementById("course_id");

    editSection.style.display = "flex";
    contentSection.style.display = "none";
    courseID.value = "-1";



}

function logout() {
    // Kullanıcıya onay penceresi göster
    if (confirm('Are you sure you want to log out?')) {
        // Kullanıcı onayladıysa, yönlendir
        window.location.href = '../../index.php'; // Burada doğru yönlendirme URL'sini kullanın
    }
}
