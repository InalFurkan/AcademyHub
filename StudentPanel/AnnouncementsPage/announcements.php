<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="style_announcements.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="script_announcements.js"></script>
    <title>Schedule</title>
</head>

<body>


    <div class="screen-elements">

        <header class="top-nav" id="topNav">
            <button id="butonTop" onclick="toggleSidePanel()">
                <img src="../../images/list_button.svg" style="height: 25px; width: 25px;">
                <img src="../../images/logo.svg" style="height: 30px; width: 120px;">
                <div style="height: 25px; width: 25px;"></div>
            </button>
        </header>


        <!-- navigation menu starts here -->
        <aside class="navbar align-items-center" id="sidePanel">
            <button class="sidePanelButton" id="closeBtn" onclick="toggleSidePanel()">
                <img src="../../images/upIcon.svg" alt="Close">
            </button>

            <img src="../../images/logo.svg" alt="logo" height="72px" width="147px">

            <nav class="container d-flex flex-column justify-content-between align-items-center">
                <ul class="links d-flex flex-column justify-content-center align-items-start">
                    <li>
                        <a href="../DashboardPage/dashboard.php" class="d-flex align-items-center">
                            <img src="../../images/house-fill.svg" alt="Dashboard Icon">
                            <h3>Dashboard</h3>
                        </a>
                    </li>

                    <li>
                        <a href="../CoursesPage/courses.php" class="d-flex align-items-center">
                            <img src="../../images/book-half.svg" alt="Courses Icon">
                            <h3>Courses</h3>
                        </a>
                    </li>

                    <li>
                        <a href="../SchedulePage/schedule.php" class="d-flex align-items-center">
                            <img src="../../images/calendar-check-fill.svg" alt="Schedule Icon">
                            <h3>Schedule</h3>
                        </a>
                    </li>

                    <li>
                        <a class="d-flex align-items-center">
                            <img src="../../images/megaphone-fill.svg" alt="Announcements Icon">
                            <h3>Announcements</h3>
                        </a>
                    </li>

                    <li>
                        <a href="../ProfilePage/profile.php" class="d-flex align-items-center">
                            <img src="../../images/person-fill.svg" alt="Profile Icon">
                            <h3>Profile</h3>
                        </a>
                    </li>
                </ul>
            </nav>

            <button class="sidePanelButton" onclick="logout()">
                Logout
            </button>
        </aside>

        <!-- navigation menu ends here -->

        <!-- schedule starts here -->
        <main id="announcement-section">
            <h1 id="announcements-text">ANNOUNCEMENTS</h1>
            <div id="announcement-cards">

            </div>


        </main>

        <!-- schedule ends here -->
    </div>

    <script src="script_announcements.js"></script>

</body>

</html>