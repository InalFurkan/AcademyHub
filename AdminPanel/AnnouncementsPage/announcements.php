<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style_announcements.css">
    <link rel="stylesheet" href="../../css/style.css">

    <title>Announcements</title>
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
            <div id="page-title-bar">Announcements Table</div>
            <div id="button-section">
                <button class="orange-button" onclick="deleteButtonClicked()">Delete</button>
                <button class="gray-button" onclick="editBtnClicked()">Edit</button>
                <button class="purple-button" onclick="createButtonClicked()">Create New</button>
            </div>

            <table id="announcements-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Announcement ID</th>
                        <th>Title</th>
                        <th class="content-cell">Content</th> <!-- Add class here -->
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Veriler burada yüklenecek -->
                </tbody>
            </table>


        </div>

        <div id="edit-section">
            <div id="page-title-bar">Edit Announcement Information</div>
            <div id="announcement-information">
                <h2>Announcement Details</h2>
                <div id="button-section">
                    <button class="gray-button" onclick="cancelButtonClicked()">Cancel</button>
                    <button class="purple-button" onclick="saveButtonClicked()">Save</button>
                </div>
                <main>
                    <form id="announcement-form">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="announcement_id" class="form-label">Announcement ID: </label>
                                    <input type="text" class="form-control" id="announcement_id" name="announcement_id"
                                        value="1" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="announcementTitle" class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="announcementTitle"
                                        name="announcementTitle" required>
                                </div>

                                <div class="mb-3">
                                    <label for="announcementContent" class="form-label">Content:</label>
                                    <textarea class="form-control" id="announcementContent" name="announcementContent"
                                        rows="4" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Created At:</label>
                                    <input type="text" class="form-control" id="created_at" name="created_at" value=""
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="updated_at" class="form-label">Updated At:</label>
                                    <input type="text" class="form-control" id="updated_at" name="updated_at" value=""
                                        readonly>
                                </div>

                            </div>

                        </div>

                    </form>
                </main>
            </div>
        </div>
    </div>


    <script src="script_announcements.js"></script>
</body>

</html>