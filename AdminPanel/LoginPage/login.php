<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy Hub - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style_login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="container-md">
        <div class="center-element">
            <div id="page-content" class="row align-items-center">
                <!-- text area -->
                <div id="text-area" class="col">
                    <div class="row"><img src="../../images/logo.svg" class="img-fluid w-100, w-50"></div>
                    <div class="row">
                        <h2>The ultimate online platform for university students.</h2>
                    </div>
                </div>

                <!-- login area -->
                <div id="login-area" class="col">
                    <div class="login_window d-flex flex-column justify-content-between">
                        <form id="login-form">
                            <div class="row-4" id="text-box">
                                <div class="row" style="height: 55px;">
                                    <h1>LOGIN</h1>
                                </div>
                                <div class="row">
                                    Welcome back. Please login to your account
                                </div>
                            </div>
                            <div class="row-4">
                                <div class="row align-self-start">
                                    <div class="mb-3">
                                        <input type="input" name="email" class="form-control" id="inputEmail"
                                            placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="row align-self-start">
                                    <input type="password" name="password" id="inputPassword" class="form-control"
                                        aria-describedby="passwordHelpBlock" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row-4">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" id="button" class="btn btn-link">Forgot your
                                            password?</button>
                                    </div>
                                    <div class="col align-self-end">
                                        <button type="submit" id="button_2"
                                            class="btn btn-outline-primary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script_login.js"></script>

</body>

</html>