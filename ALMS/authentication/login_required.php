<?php 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php
    include "../css.php";
    ?>

    <title>Login Page</title>
    <style>
        body {
            background-color: #f3f3f3;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .invalid {
            color: red;
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
                    <div class="card border-rounded">
                        <div class="row d-flex align-items-center justify-content-center g-0">
                            <div class="card-body h-100 p-4 p-lg-5 text-black">
                                <div
                                    class="container h-100 d-flex flex-column justify-content-center align-items-center py-5">
                                    <i class="bi bi-key" style="font-size:100px"></i>
                                    <span class='h1'>Please login in to your account.</span>
                                    <span class='h4'>Redirecting you to login in <span id='counter'>5</span>
                                        Seconds</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function redirectToLogin() {
            function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML) <= 0) {
                    location.href = '../login/login.php';
                }
                if (parseInt(i.innerHTML) != 0) {
                    i.innerHTML = parseInt(i.innerHTML) - 1;
                }
            }
            setInterval(function () {
                countdown();
            }, 1000);
        }

        redirectToLogin();
    </script>
</body>


</html>