<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="script_students.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="style_students.css">
    <title>Manage Student Information</title>
</head>

<body>
    <div class="screen-elements">

        <div class="navbar align-items-center" id="sidePanel">

            <img src="../../images/logo.svg" alt="logo" height="72" width="147">

            <div class="container d-flex flex-column justify-content-between align-items-center">
                <div class="col links d-flex flex-column justify-content-center align-items-start">


                    <a href="../StudentsPage/students.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/book-half.svg" alt="Students Icon">
                            </div>
                            <div class="col">
                                <h3>Students</h3>
                            </div>
                        </div>
                    </a>

                    <a href="../CoursesPage/courses.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/calendar-check-fill.svg" alt="Courses Icon">
                            </div>
                            <div class="col">
                                <h3>Courses</h3>
                            </div>
                        </div>
                    </a>

                    <a href="../AnnouncementsPage/announcements.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/megaphone-fill.svg" alt="Announcements Icon">
                            </div>
                            <div class="col">
                                <h3>Announcements</h3>
                            </div>
                        </div>
                    </a>


                </div>
            </div>

            <button class="sidePanelButton" id="logoutBtn" onclick="logout()">
                Logout
            </button>
        </div>


        <main id="content-section">

            <div id="page-title-bar">Students Table</div>
            <div id="content-button-section" class="button-section">
                <button class="orange-button" onclick="deleteButtonClicked()">Delete</button>
                <button class="gray-button" onclick="editBtnClicked()">Edit</button>
                <button class="purple-button" onclick="createButtonClicked()">Create New</button>
            </div>
            <table id="students_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>student id</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Field Of Study</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Receive SMS</th>
                        <th>Receive Email</th>
                        <th>GPA</th>
                    </tr>
                </thead>

                <tbody>
                    <?php include 'php/fetch_students.php'; ?>
                </tbody>

            </table>


        </main>



        <section id="student-details">
            <div id="page-title-bar">Manage Student Information</div>
            <div id="student-information">
                <h2>Student Information</h2>
                <div id="details-button-section" class="button-section">
                    <button class="gray-button" onclick="cancelEditing()">Cancel</button>
                    <button class="purple-button" onclick="saveButtonClicked()">Save</button>
                </div>
                <main>
                    <form id="studentForm" action="php/save_student.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Student ID: </label>
                                    <input type="text" class="form-control" id="student_id" name="student_id"
                                        value="<?php echo isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : ''; ?>"
                                        readonly autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="studentName" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="studentName" name="studentName" required
                                        autocomplete="given-name">
                                </div>
                                <div class="mb-3">
                                    <label for="studentSurname" class="form-label">Surname:</label>
                                    <input type="text" class="form-control" id="studentSurname" name="studentSurname"
                                        required autocomplete="family-name">
                                </div>
                                <div class="mb-3">
                                    <label for="fieldOfStudy" class="form-label">Field Of Study:</label>
                                    <select class="form-select" id="fieldOfStudy" name="fieldOfStudy" required
                                        onchange="updateCourseList()" autocomplete="off">
                                        <option value="" disabled selected>Select field of study</option>
                                        <?php include 'php/get_field_of_study.php'; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        autocomplete="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required
                                        autocomplete="tel">
                                </div>
                                <div class="mb-3">
                                    <label for="gpa" class="form-label">GPA:</label>
                                    <input type="number" class="form-control" id="gpa" name="gpa" readonly value="0.00"
                                        step="0.01" min="0" max="4" autocomplete="off">
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="smsYes">Receive SMS:</label>
                                        <div class="radio-border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="smsYes"
                                                    name="receiveSMS" value="1" required autocomplete="off">
                                                <label class="form-check-label" for="smsYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="smsNo"
                                                    name="receiveSMS" value="0" required autocomplete="off">
                                                <label class="form-check-label" for="smsNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="emailYes">Receive Email:</label>
                                        <div class="radio-border">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="emailYes"
                                                    name="receiveEmail" value="1" required autocomplete="off">
                                                <label class="form-check-label" for="emailYes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="emailNo"
                                                    name="receiveEmail" value="0" required autocomplete="off">
                                                <label class="form-check-label" for="emailNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </main>
            </div>

            <div id="courses-information">
                <h2>Enrolled Courses</h2>
                <table id="enrolled-table" class="table">
                    <thead>
                        <tr>
                            <th>Select To Remove</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Midterm Result</th>
                            <th>Final Result</th>
                            <th>Average</th>
                            <th>Letter Grade</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php include 'php/fetch_courses_enrolled.php'; ?>
                    </tbody>

                </table>
                <button class="btn btn-primary" onclick="removeBtnClicked()">Remove</button>

                <!-- course ekle başlangıç -->
                <div id="add-course-section">
                    <h2>Add New Course</h2>
                    <form id="add-course-form">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="newCourseName" class="form-label">Course Name</label>
                                <select class="form-select" id="newCourseName" name="newCourseName" required
                                    autocomplete="off">
                                    <option value="">Select course</option>
                                    <!-- Options will be populated here -->
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="newMidtermResult" class="form-label">Midterm Result</label>
                                <input type="number" class="form-control" id="newMidtermResult" name="newMidtermResult"
                                    min="0" max="100" placeholder="Enter Midterm Result" required autocomplete="off">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="newFinalResult" class="form-label">Final Result</label>
                                <input type="number" class="form-control" id="newFinalResult" name="newFinalResult"
                                    min="0" max="100" placeholder="Enter Final Result" required autocomplete="off">
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-primary"
                                    onclick="addCourseBtnClicked()">Add</button>
                            </div>
                        </div>
                    </form>

                </div>


                <!-- Enrollments to be added -->
                <h2>Enrollments to be Added</h2>
                <table id="enrollments-to-add" class="table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Midterm Result</th>
                            <th>Final Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- This will be populated dynamically -->
                    </tbody>
                </table>

                <!-- Enrollments to be removed -->
                <h2>Enrollments to be Removed</h2>
                <table id="enrollments-to-remove" class="table">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Midterm Result</th>
                            <th>Final Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- This will be populated dynamically -->
                    </tbody>
                </table>







        </section>

    </div>





    <script src="script_students.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>