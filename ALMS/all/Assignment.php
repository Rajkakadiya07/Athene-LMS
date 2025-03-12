<?php 
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

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .modal-dialog {
            position: fixed;
            margin: auto;
            margin-top: 20px;
            width: 1100px;
            height: auto;
            right: 0px;

        }

        .modal-content {
            height: 100%;
        }
    </style>
</head>


<body>
    <?php
require_once "../sidebar.php";
require_once "../header.php";

    ?>


    <main id="main" class="main ps-0">


        <div class="pagetitle ms-2">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Admin.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="./Admin.php">Dashboard</a></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <div class="card  ps-1 col-11    ">


            <div class="card-body">
                <h5 class="card-title"><i class="ri-clipboard-fill h5"></i> Assignment 1 </h5>
                <div class="d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./Admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="./Acourse.php">Course</a></li>
                            <li class="breadcrumb-item"><a href="#">Calander</a></li>
                            <li class="breadcrumb-item active"><a href="#">Reports</a></li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>

        <div class="card ps-1 col-11">
            <div class="card-body">
                <div class="mb-4"></div>
                <span class="text-dark h5">Opened : Monday 4 April 2023</span>
                <hr class="text-dark">
                <span class="text-dark h5">Due : Friday 8 April 2023</span>
                <hr class="text-dark">  
                <div>
                    <button type="reset" class="btn btn-success">View submissions</button>
                </div>

            </div>
        </div>
        <div class="card ps-1 col-11">
            <div class="card-body">
                <div class="card-title">Grading Summary </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Hidden From Students</th>
                            <th scope="col">Participents</th>
                            <th scope="col">Submitted</th>
                            <th scope="col">Needs Grading</th>
                            <th scope="col">Time remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>20</td>
                            <td>15</td>
                            <td>0</td>
                            <td>7 Days 16 hours remaining</td>
                        </tr>

                    </tbody>
                </table>
                <div>

                    <button type="submit" class="btn btn-secondary">Remove submission</button> &nbsp;&nbsp;
                    <button type="reset" class="btn btn-success">Edit submission</button>
                </div>
            </div>
        </div>

    </main>





    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTab"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">



    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>


</body>

</html>
<section class="section dashboard">


    <!-- Left side columns -->