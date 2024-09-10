<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="script_courses.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style_courses.css">
    <link rel="stylesheet" href="../../css/style.css">



    <title>Courses</title>
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
        <div id="content-section">
            <div id="page-title-bar">Courses Table</div>
            <div id="button-section">
                <button class="orange-button" onclick="deleteButtonClicked()">Delete</button>
                <button class="gray-button" onclick="editButtonClicked()">Edit</button>
                <button class="purple-button" onclick="createButtonClicked()">Create New</button>
            </div>

            <table id="courses-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Field</th>
                    </tr>
                </thead>

                <tbody>
                    <?php include 'php/fetch_courses.php'; ?>
                </tbody>

            </table>

        </div>

        <div id="edit-section">
            <div id="page-title-bar">Edit Course Infromation</div>
            <div id="course-information">
                <h2>Course Details</h2>
                <div id="button-section">
                    <button class="gray-button" onclick="cancelButtonClicked()">Cancel</button>
                    <button class="purple-button" onclick="saveButtonClicked()">Save</button>
                </div>
                <main>
                    <form action="php/course_schedule.php" method="post" id="course-form">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="course_id" class="form-label">Course ID: </label>
                                    <input type="text" class="form-control" id="course_id" name="course_id" value="1"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="courseName" class="form-label">Course Name:</label>
                                    <input type="text" class="form-control" id="courseName" name="courseName" required>
                                </div>

                                <div class="mb-3">
                                    <label for="fieldOfStudy" class="form-label">Field:</label>
                                    <select class="form-select" id="fieldOfStudy" name="fieldOfStudy" required
                                        onchange="updateCourseList()">
                                        <option value="" disabled selected>Select field of study</option>
                                        <!-- PHP kodu ile seçenekler eklenecek -->
                                        <?php include '../StudentsPage/php/get_field_of_study.php'; ?>
                                    </select>

                                </div>


                            </div>

                        </div>


                    </form>
                </main>

                <h2>Course Schedule</h2>

                <?php
                include 'php/fetch_course_info.php';

                ?>

                <form id="schedule-form">
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="dayId" class="form-label">Day:</label>
                                <select class="form-select" id="dayId" name="dayId" required>
                                    <option value="" disabled selected>Select The Day</option>
                                    <?php include 'php/fetch_days.php'; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="startTime" class="form-label">Start Time:</label>
                                <input type="time" class="form-control" id="startTime" name="startTime" step="300"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="finishTime" class="form-label">Finish Time:</label>
                                <input type="time" class="form-control" id="finishTime" name="finishTime" step="300"
                                    required>
                            </div>
                        </div>

                    </div>
                </form>

                <button class="col btn-group" id="addButton" onclick="add_temp_clicked()">Add</button>
                <button class="btn-group" id="delButton" onclick="remove_temp_clicked()">Delete</button>


                <table id="schedule-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Day</th>
                            <th>Starting Time</th>
                            <th>Ending Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php include 'php/fetch_course_schedule.php'; ?> -->
                    </tbody>
                </table>


                <table id="to-be-added-table" class="table table-striped">
                    <h3>Classes To Be Added</h3>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Starting Time</th>
                            <th>Ending Time</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <table id="to-be-removed" class="table table-striped">
                    <h3>Classes To Be Removed</h3>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Starting Time</th>
                            <th>Ending Time</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>


            </div>
        </div>
    </div>





</body>

</html>