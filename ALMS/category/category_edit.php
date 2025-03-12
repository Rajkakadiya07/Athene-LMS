<?php
session_start();
$_SESSION['cat_id'] = $_GET['catId'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }
    </style>
</head>

<body>
    <?php
    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <main id="main" class="main">



        <div class="pagetitle ms-2">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Category</a></li>
                    <li class="breadcrumb-item active"><a href="">Edit</a></li>
                </ol>
            </nav>
        </div>

        <div class="card ms-3 col-11 ">
            <div class="card-body">
                <div class="col-xl-12 mt-4">
                    <form id="createCategory" action="category_db.php" method="post">
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-dark" for="shortname">Category Short Name</label>
                                        <input type="text" class="form-control" id="shortname" name="ushortname" placeholder="Enter Category Short Name" value="<?php echo isset($_GET['catShortName']) ? $_GET['catShortName'] : "" ?>">
                                        <p class="invalid" id="categoryShortName"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-dark" for="fullname">Category Full Name</label>
                                        <input type="text" class="form-control" id="fullname" name="ufullname" placeholder="Enter Category Full Name" value="<?php echo isset($_GET['catFullName']) ? $_GET['catFullName'] : "" ?>">
                                        <p class="invalid" id="categoryFullName"></p>
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" name="updateForm" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        </div>

        <!--second tab-->

        <!-- End  Tab -->
    </main>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script>
        $(document).ready(function() {
            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();
                shortname = document.getElementById('shortname').value;
                fullname = document.getElementById('fullname').value;

                if (fullname == "" && shortname == "") {
                    $('#categoryShortName').show();
                    $('#categoryShortName').html("Please enter a short name");
                    $('#categoryFullName').show();
                    $('#categoryFullName').html("Please enter a full name");
                    return false;
                } else if (shortname == "") {
                    $('#categoryShortName').show();
                    $('#categoryShortName').html("Please enter a short name");
                    return false;
                } else if (fullname == "") {
                    $('#categoryFullName').show();
                    $('#categoryFullName').html("Please enter a full name");
                    return false;
                }
                form.submit();
            });



            // Remove warnings after altered inputs

            $('input').on('input', function(e) {
                if (e.target.id == "shortname") {
                    $('#categoryShortName').hide();
                } else if (e.target.id == "fullname") {
                    $('#categoryFullName').hide();
                }
            });

        });
    </script>
    <?php require_once "../js.php" ?>


</html>