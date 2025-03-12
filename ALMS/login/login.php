<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login Page</title>
    <style>
        body {
            background-color: #f3f3f3;
        }

        .card-img-top {
            object-fit: cover;
            max-height: 100%;
        }

        .invalid {
            color: red;;9iik
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100 box">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10 h-100">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../assets/img/16.jpg" alt="login form" class="card-img-top img-fluid" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center h-100">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="post" autofocus="on">

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Athene LMS</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 2px;">Sign into your
                                            account</h5>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">User ID</label>
                                            <input type="text" id="username" class="form-control form-control-lg" />
                                            <span id="uname" class="invalid"></span>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control form-control-lg" autocomplete="off" />
                                            <span id="pass" class="invalid"></span>
                                        </div>


                                        <div class="pt-1 mb-4">
                                            <input class="btn btn-outline-primary btn-lg btn-block" type="submit" id="btnLogin" value="Login" disabled />
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mt-4 text-center">Don't have Account ?<br><a href="../registration/registration.php">Register Here</a>
                                        </p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script>
        $(document).ready(function() {

            $("input").on("input", function() {
                if ($("#username").val() != "" && $("#password").val().length >= 4) {
                    $("input[type='submit']").removeAttr('disabled');
                } else {
                    $("input[type='submit']").attr('disabled', 'disabled');
                }
            });

            $("input").on("input", function(e) {
                $(e.target).next('span').html("");
                $(e.target).next('span').hide();
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                name = $('#username').val();
                pass = $('#password').val();
                $.ajax({
                    method: "post",
                    url: "login_user.php",
                    data: {
                        username: name,
                        password: pass
                    },
                    success: function(response) {
                        obj = JSON.parse(response);
                        code = obj.code;
                        pcode = obj.pcode;
                        usertype = obj.usertype;
                        message = obj.message;
                        send = obj.canlogin;
                        if (code == 100) {
                            $("#uname").html(message);
                            $("#uname").show();
                        }

                        if (pcode == 101) {
                            $("#pass").html(message);
                            $("#pass").show();
                        }

                        if (code == 0 && send == true) {
                            if (usertype == "admin") {
                                location.href = "../dashboard/dashboard_admin.php";
                            } else if (usertype == "teacher") {
                                location.href = "../dashboard/dashboard_teacher.php";
                            } else if (usertype == "student") {
                                location.href = "../dashboard/dashboard_student.php";
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>