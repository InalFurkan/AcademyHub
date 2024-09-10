<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style_dashboard.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="script_dashboard.js"></script>



</head>

<body>


    <div class="col" id="page">

        <div class="top-bar row">
            <div class="col">
                <div id="logo-bar">
                    <img src="../../images/logo.svg" style="height: 40px; width: 160px;">
                </div>
            </div>
            <div class="col-3">
                <button id="logout-button" onclick="logout()">
                    Logout
                </button>
            </div>
        </div>

        <div class="row" id="page-header">DASHBOARD PAGE</div>


        <div class="row buttons">

            <div class="row rows">


                <button onclick="navigateCourses()" class="button">
                    <div class="col">
                        <h3>Courses</h3>
                    </div>
                    <div class="col">
                        <img src="../../images/book.svg">
                    </div>
                </button>

                <button class="button" onclick="navigateSchedule()">
                    <div class="col">
                        <h3>Schedule</h3>
                    </div>
                    <div class="col">
                        <img src="../../images/calendar4-week.svg" alt="">
                    </div>
                </button>



            </div>
            <div class="row rows">

                <button class="button dynamic" onclick="navigateAnnouncements()">
                    <div class="col">
                        <h3>Announcements</h3>
                    </div>
                    <div class="col">
                        <img src="../../images/bell.svg" alt="">
                    </div>
                </button>

                <button class="button dynamic" onclick="navigateProfile()">
                    <div class="col">
                        <h3>Profile</h3>
                    </div>
                    <div class="col">
                        <img src="../../images/person.svg" alt="">
                    </div>
                </button>

            </div>

        </div>



    </div>

</body>

</html>