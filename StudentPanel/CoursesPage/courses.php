<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="style_courses.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <title>Courses</title>
</head>

<body>

    <div class="screen-elements">

        <div class="top-nav" id="topNav">
            <button id="butonTop" onclick="toggleSidePanel()">
                <img src="../../images/list_button.svg" style="height: 25px; width: 25px;">
                <img src="../../images/logo.svg" style="height: 30px; width: 120px;">
                <div style="height: 25px; width: 25px;"></div>
            </button>
        </div>


        <!-- navigation menu starts here -->
        <div class="navbar align-items-center" id="sidePanel">
            <button class="sidePanelButton" id="closeBtn" onclick="toggleSidePanel()">
                <img src="../../images/upIcon.svg">
            </button>

            <img src="../../images/logo.svg" alt="logo" height="72px" width="147px">


            <div class="container d-flex flex-column justify-content-between align-items-center">

                <div class="col links d-flex flex-column justify-content-center align-items-start">
                    <a href="../DashboardPage/dashboard.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/house-fill.svg" alt="house_icon">
                            </div>
                            <div class="col">
                                <h3>Dashboard</h3>
                            </div>
                        </div>

                    </a>


                    <a>
                        <div class="row">
                            <div class="col">
                                <img src="../../images/book-half.svg" alt="courses_icon">
                            </div>
                            <div class="col">
                                <h3>Courses</h3>
                            </div>
                        </div>

                    </a>

                    <a href="../SchedulePage/schedule.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/calendar-check-fill.svg" alt="schedule_icon">
                            </div>
                            <div class="col">
                                <h3>Schedule</h3>
                            </div>
                        </div>

                    </a>

                    <a href="../AnnouncementsPage/announcements.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/megaphone-fill.svg" alt="announcements_icon">
                            </div>
                            <div class="col">
                                <h3>Announcements</h3>
                            </div>
                        </div>

                    </a>

                    <a href="../ProfilePage/profile.php">
                        <div class="row">
                            <div class="col">
                                <img src="../../images/person-fill.svg" alt="profile_icon">
                            </div>
                            <div class="col">
                                <h3>Profile</h3>
                            </div>
                        </div>

                    </a>
                </div>



            </div>
            <button class="sidePanelButton" onclick="logout()">
                Logout
            </button>

        </div>
        <!-- navigation menu ends here -->

        <!-- schedule starts here -->
        <div class="col">
            <div id="content-section">

                <h1 id="profile-text">Courses</h1>

                <div class="blocks">

                </div>


                <div id="button-section">


                    <div class="col">
                        <h1 id="gpa">GPA: 3.00</h1>
                    </div>

                    <div class="col color-info">
                        <div class="row">
                            <div class="col">
                                <div class="circle succeed"></div>
                                Succeed
                            </div>

                            <div class="col">
                                <div class="circle failed"></div>
                                Failed
                            </div>

                            <div class="col">
                                <div class="circle not-announced"></div>
                                Not Fully Announced

                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>



        <script src="script_courses.js"></script>
</body>


</html>