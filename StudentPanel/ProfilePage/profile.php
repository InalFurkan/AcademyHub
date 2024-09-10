<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="style_profile.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="script_profile.js"></script>
    <title>Schedule</title>
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


                    <a href="../CoursesPage/Courses.php">
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

                    <a>
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
            <button class="sidePanelButton" onclick="logout()" id="logoutButton">
                Logout
            </button>

        </div>
        <!-- navigation menu ends here -->

        <!-- schedule starts here -->
        <div class="col">
            <div id="content-section">
                <h1 id="profile-text">PROFILE PAGE</h1>

                <div id="cards-section">
                    <div class="card" id="card_profile">
                        <img id="avatar_picture" src="../../images/avatar_picture.jpg">
                        <div id="personal_info" class="col">
                            <div class="row bold-big-text">
                                <h3 id="studentName">Student Name</h3>
                            </div>
                            <div class="row small-title-text">
                                <h5>field of study</h5>
                            </div>
                            <div class="row" id="fieldOfStudy">
                                <h3 id="field">Computer Engineering</h3>
                            </div>
                            <div class="row small-title-text">
                                <h5>student number</h5>
                            </div>
                            <div class="row" id="studentNumber">
                                <h3 id="studentId">103*****00</h3>
                            </div>
                        </div>

                    </div>

                    <div class="card" id="card_contact">
                        <div class="row bold-big-text">
                            <h3>CONTACT INFORMATION</h3>
                        </div>
                        <div class="row" id="fieldOfStudyTitle">
                            <h5>e-mail address</h5>
                        </div>
                        <div class="row" id="fieldOfStudy">
                            <h3 id="email">example@mail.com</h3>
                        </div>
                        <div class="row" id="studentNumberTitle">
                            <h5>phone number</h5>
                        </div>
                        <div class="row" id="studentNumber">
                            <h3 id="phoneNumber">+90(505)1234567</h3>
                        </div>
                    </div>

                    <div class="card" id="card_notifications">
                        <div class="row bold-big-text">
                            <h3>NOTIFICATION SETTINGS</h3>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h3>Receive SMS</h3>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="receive_sms" id="receive_sms_yes"
                                        value="1" checked required autocomplete="off">
                                    <label class="form-check-label" for="receive_sms_yes">
                                        <h2>YES</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="receive_sms" id="receive_sms_no"
                                        value="0" required autocomplete="off">
                                    <label class="form-check-label" for="receive_sms_no">
                                        <h2>NO</h2>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <h3>Receive E-Mail</h3>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="receive_email"
                                        id="receive_email_yes" value="1" checked required autocomplete="off">
                                    <label class="form-check-label" for="receive_email_yes">
                                        <h2>YES</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="receive_email"
                                        id="receive_email_no" value="0" required autocomplete="off">
                                    <label class="form-check-label" for="receive_email_no">
                                        <h2>NO</h2>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card password-field">
                        <div class="row bold-big-text">
                            <h3>CHANGE PASSWORD</h3>
                        </div>
                        <div class="row">
                            <input type="password" id="inputPassword" class="form-control"
                                aria-describedby="passwordHelpBlock" placeholder="Current Password">
                        </div>

                        <div class=" row">
                            <input type="password" id="inputNewPassword" class="form-control"
                                aria-describedby="passwordHelpBlock" placeholder="New Password">
                        </div>

                        <div class="row">
                            <input type="password" id="inputNewPassword2" class="form-control"
                                aria-describedby="passwordHelpBlock" placeholder="New Password">
                        </div>
                    </div>

                </div>



            </div>
            <div id="button-section">
                <button>Cancel</button>
                <button id="saveButton">Save</button>
            </div>
        </div>

    </div>

    <!-- schedule ends here -->
    </div>




</html>