
document.addEventListener('DOMContentLoaded', function () {
    resetTables();
});


function updateCourseList() {
    var fieldOfStudy = document.getElementById('fieldOfStudy').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/get_courses_list.php?field_of_study=' + fieldOfStudy, true);
    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('newCourseName').innerHTML = this.responseText;
        }
    };
    xhr.send();
}



function editBtnClicked() {
    loadRemoveTable();
    loadAddTable();

    var buttonSection = document.getElementById("details-button-section");
    var studentTable = document.getElementById('students_table');
    var contentSection = document.getElementById('content-section');
    var studentDetailsPanel = document.getElementById('student-details');
    var editSection = document.getElementById("edit-section");
    var selectedStudent = studentTable ? studentTable.querySelector('tbody tr td:first-child input[type="radio"]:checked') : null;

    // buttonSection.style.display = 'flex';

    if (selectedStudent) {
        var studentId = selectedStudent.closest('tr').querySelector('td:nth-child(2)').textContent.trim();
        console.log("studentID =", +studentId);
        xhr = new XMLHttpRequest();
        xhr.open("POST", "php/fetch_student_by_id.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("student_id=" + encodeURIComponent(studentId));

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("success 200");
                try {
                    var response = JSON.parse(xhr.responseText);
                    var studentData = response.student;
                    var enrolledCourses = response.enrolled_courses;


                    // Populate student information form
                    document.getElementById('student_id').value = studentData.student_id;
                    document.getElementById('studentName').value = studentData.name;
                    document.getElementById('studentSurname').value = studentData.surname;
                    document.getElementById('fieldOfStudy').value = studentData.field_of_study;
                    document.getElementById('email').value = studentData.email;
                    document.getElementById('phoneNumber').value = studentData.phone_number;
                    document.querySelector(`input[name="receiveSMS"][value="${studentData.receive_sms}"]`).checked = true;
                    document.querySelector(`input[name="receiveEmail"][value="${studentData.receive_email}"]`).checked = true;
                    document.getElementById('gpa').value = studentData.gpa;

                    // Populate enrolled courses table
                    var enrolledTable = document.getElementById('enrolled-table');
                    var tableBody = enrolledTable.querySelector('tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    enrolledCourses.forEach(function (course) {
                        var row = tableBody.insertRow();

                        var radioCell = row.insertCell(0);
                        var radioButton = document.createElement('input');
                        radioButton.type = 'radio';
                        radioButton.name = 'enrolledCourse';
                        radioButton.value = course.enrollment_id;
                        radioCell.appendChild(radioButton);

                        row.insertCell(1).textContent = course.enrollment_id;
                        row.insertCell(2).textContent = course.course_name;
                        row.insertCell(3).textContent = course.midterm_score;
                        row.insertCell(4).textContent = course.final_score;
                        row.insertCell(5).textContent = course.average;
                        row.insertCell(6).textContent = course.letter_grade;
                    });







                    // Show the student details section
                    document.getElementById('student-details').style.display = 'flex';
                    document.getElementById('content-section').style.display = 'none';
                    updateCourseList();
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    console.error('Raw response:', xhr.responseText);
                }
            } else {
                console.error('Error fetching student data');
            }
        };


    } else {
        console.log("No student selected or student table not found.");
    }
}

function createNewStudent() {
    document.getElementById('studentForm').reset();
    document.getElementById('student_id').value = ''; // Student ID'yi boş bırak

}

function cancelEditing() {
    var studentDetailsPanel = document.getElementById('student-details');
    var contentSection = document.getElementById('content-section');
    studentDetailsPanel.style.display = 'none';
    contentSection.style.display = 'flex';

    resetTables();
}

function removeBtnClicked() {
    console.log("removeBtnClicked");
    var enrollmentTable = document.getElementById('enrolled-table');
    var selectedEnrollment = enrollmentTable ? enrollmentTable.querySelector('tbody tr td:first-child input[type="radio"]:checked') : null;

    if (selectedEnrollment) {
        var enrollmentId = selectedEnrollment.closest('tr').querySelector('td:nth-child(2)').textContent.trim();
        console.log("enrollmentID =", enrollmentId);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/add_to_be_removed_table.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("enrollmentID=" + encodeURIComponent(enrollmentId));

        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log("success 200");
                try {
                    var response = JSON.parse(xhr.responseText);
                    var studentData = response.student;
                    var enrolledCourses = response.enrolled_courses;
                    console.log("successs");
                    loadRemoveTable();
                }
                catch {
                    console.log("Error parsing JSON:", error);
                    console.log("Raw response:", xhr.responseText);
                }
            }
        }
    }
    else {
        alert("No enrollment selected");
    }
}

function addCourseBtnClicked() {
    console.log("addCourseBtnClicked");
    var enrollmentTable = document.getElementById('enrollments-to-add');
    var selectedCourse = document.getElementById('newCourseName').value;
    var midtermScore = document.getElementById('newMidtermResult').value;
    var finalScore = document.getElementById('newFinalResult').value;

    if (selectedCourse && midtermScore && finalScore) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/add_to_be_added_table.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) { // Request is complete
                if (xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            loadAddTable(); // Refresh the table

                        } else if (response.status === 'warning') {
                            alert(response.message);
                        } else {
                            alert("An error occurred: " + response.message);
                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else {
                    console.error("Request failed. Status:", xhr.status);
                }
            }
        };
        xhr.send("courseId=" + encodeURIComponent(selectedCourse) +
            "&midtermScore=" + encodeURIComponent(midtermScore) +
            "&finalScore=" + encodeURIComponent(finalScore));
    } else {
        alert("Please fill in all fields.");
    }
}


function resetTables() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/reset_tables.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert("Tables reset successfully.");
                } else {
                    alert("An error occurred: " + response.message);
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        } else {
            console.error("Request failed. Status:", xhr.status);
        }
    };
    xhr.send();
}

function loadRemoveTable() {
    var coursesTable = document.getElementById("enrollments-to-remove");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/load_remove_table.php", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                var courses = JSON.parse(xhr.responseText);
                coursesTable.tBodies[0].innerHTML = "";

                if (Array.isArray(courses) && courses.length > 0) {
                    courses.forEach(function (courses) {
                        var row = coursesTable.tBodies[0].insertRow();
                        row.innerHTML =
                            "<td>" + courses.course_name + "</td>" +
                            "<td>" + courses.midterm_score + "</td>" +
                            "<td>" + courses.final_score + "</td>";
                    });
                } else {
                    coursesTable.tBodies[0].innerHTML = "<tr><td colspan='3'>No Course data available</td></tr>";
                }
            } catch (error) {
                console.error("Error parsing JSON:", error);
                coursesTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Error loading courses data</td></tr>";
            }
        } else {
            console.error("Request failed. Status:", xhr.status);
            coursesTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Failed to load course data</td></tr>";
        }
    };
    xhr.send();
}


function loadAddTable() {
    var enrollmentsTable = document.getElementById("enrollments-to-add");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "php/load_add_table.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) { // Check if request is complete
            if (xhr.status === 200) {
                try {
                    var enrollments = JSON.parse(xhr.responseText);
                    enrollmentsTable.tBodies[0].innerHTML = "";

                    if (Array.isArray(enrollments) && enrollments.length > 0) {
                        enrollments.forEach(function (enrollment) {
                            var row = enrollmentsTable.tBodies[0].insertRow();
                            row.innerHTML =
                                "<td>" + enrollment.course_name + "</td>" +
                                "<td>" + enrollment.midterm_score + "</td>" +
                                "<td>" + enrollment.final_score + "</td>";
                        });
                    } else {
                        enrollmentsTable.tBodies[0].innerHTML = "<tr><td colspan='3'>No Enrollment data available</td></tr>";
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    enrollmentsTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Error loading enrollment data</td></tr>";
                }
            } else {
                console.error("Request failed. Status:", xhr.status);
                enrollmentsTable.tBodies[0].innerHTML = "<tr><td colspan='3'>Failed to load enrollment data</td></tr>";
            }
        }
    };

    xhr.send();
}

function saveButtonClicked() {

    console.log("saveButtonClicked function called");

    var studentID = document.getElementById('student_id').value;
    var studentName = document.getElementById('studentName').value;
    var studentSurname = document.getElementById('studentSurname').value;
    var fieldOfStudy = document.getElementById('fieldOfStudy').value;
    var emailAddress = document.getElementById('email').value;
    var phoneNumber = document.getElementById('phoneNumber').value;
    var receiveSMS = document.querySelector(`input[name="receiveSMS"]:checked`);
    var receiveEmail = document.querySelector(`input[name="receiveEmail"]:checked`);
    var gpa = document.getElementById('gpa').value;



    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/save_student.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert('Student data saved successfully.');

                location.reload();

            } else {
                alert('Error saving student data: ' + response.message);
            }
        } else {
            alert('Request failed. Status: ' + xhr.status);
        }
    };
    xhr.send(
        'studentID=' + encodeURIComponent(studentID) +
        '&studentName=' + encodeURIComponent(studentName) +
        '&studentSurname=' + encodeURIComponent(studentSurname) +
        '&fieldOfStudy=' + encodeURIComponent(fieldOfStudy) +
        '&email=' + encodeURIComponent(emailAddress) +
        '&phoneNumber=' + encodeURIComponent(phoneNumber) +
        '&receiveSMS=' + encodeURIComponent(receiveSMS) +
        '&receiveEmail=' + encodeURIComponent(receiveEmail) +
        '&gpa=' + encodeURIComponent(gpa)
    );
}

function deleteButtonClicked() {
    var studentsTable = document.getElementById('students_table');
    var selectedButton = studentsTable.querySelector('tbody tr td:first-child input[type="radio"]:checked');
    if (selectedButton) {
        var studentId = selectedButton.value;
        if (confirm("Are you sure you want to delete this student?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "php/delete_student.php?student_id=" + encodeURIComponent(studentId), true);
            xhr.send();

            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Student deleted successfully");
                    location.reload();
                } else {
                    alert("Error deleting student. Please try again.");
                }
            };
        }
    }
    else {
        alert("Please select a student to delete");
    }
}

function createButtonClicked() {
    console.log("createButtonClicked function called");
    cancelEditing();
    document.getElementById('student-details').style.display = 'flex';
    document.getElementById('content-section').style.display = 'none';
    document.getElementById('student_id').value = -1;


}

function logout() {
    // Kullanıcıya onay penceresi göster
    if (confirm('Are you sure you want to log out?')) {
        // Kullanıcı onayladıysa, yönlendir
        window.location.href = '../../index.php'; // Burada doğru yönlendirme URL'sini kullanın
    }
}