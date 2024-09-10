<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Academy Hub - Login</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style_homepage.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="script_index.js"></script>

</head>

<body>
    <div class="container-md">

        <div id="page-content" class="row align-items-center">
            <!-- text area -->
            <div id="text-area" class="col d-flex ">
                <div id="text-field">
                    <div class="row"><img src="images/logo.svg" class="img-fluid w-100, w-50"></div>

                    <div class="row">
                        <h2>The ultimate online platform for university students.</h2>
                    </div>
                </div>

            </div>

            <!-- login area -->

            <div id="login-buttons" class="col d-flex flex-column align-items-center">
                <div class="row">
                    <button id="student-btn" onclick="navigateToPage('student')">
                        <div class="row">
                            <div class="col-8">STUDENT LOGIN</div>
                            <div class="col-4"><img src="images/student_icon.svg" height="50px" width="50px"></div>
                        </div>

                    </button>
                </div>
                <div class="row">
                    <button id="admin-btn" onclick="navigateToPage('admin')">
                        <div class="row">
                            <div class="col-8">ADMIN LOGIN</div>
                            <div class="col-4"><img src="images/admin_icon.svg" height="50px" width="50px"></div>
                        </div>

                    </button>

                </div>
            </div>

        </div>





</body>

</html>