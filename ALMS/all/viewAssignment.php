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

        <!-- Button trigger modal -->
        <div class="modal fade bd-example-modal-lg" id="mod" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="">Edit Material</h5>
                        <button type="button" class="close h4" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row  ">
                                <div class="col-12 ">
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description"> Name</label>
                                        <div class="col-md-10 mt-2">
                                            <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Quiz Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description">Description </label>
                                        <div class="col-md-10 mt-2">
                                            <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Description">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description">Marks</label>
                                        <div class="col-md-10 mt-2">
                                            <input type="number" class="form-control" id="course_title" name="title" placeholder="Enter Total Marks">
                                        </div>
                                    </div>

                                    <!-- <br><br><br> -->
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description">Start Date</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="course_title" name="title">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description">End Date</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="course_title" name="title">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark" for="short_description">Upload File</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" id="course_title" name="title">
                                        </div>
                                    </div>

                                    <br>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>

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
        =
        <div class="card  ps-1 col-11 recent-sales overflow-auto">



            <div class="card-body">
                <h5 class="card-title">submissions</h5>

                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                    <div class="dataTable-top">
                        <div class="dataTable-dropdown"><label><select class="dataTable-selector">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page</label></div>
                        <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
                    </div>
                    <div class="dataTable-container">
                        <table class="table table-borderless datatable dataTable-table">
                            <thead>
                                <tr>
                                    <th scope="col" data-sortable=""> <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
                                    <th scope="col" data-sortable="">Name</th>
                                    <th scope="col" data-sortable="">Email</th>
                                    <th scope="col" data-sortable="">Status</th>
                                    <th scope="col" data-sortable="">Grade</th>
                                    <th scope="col" data-sortable="">Last Modified</th>
                                    <th scope="col" data-sortable="">File Submissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
                                    <td>Raj Kakadiya</td>
                                    <td>rajkakadiya@gmail.com</td>
                                    <td><span class="badge bg-success">Submitted</span></td>
                                    <td><button type="reset" class="btn btn-sm btn-primary">Grade</button><br>
                                    <span class="text-dark">&nbsp;9.0/10</span></td>
                                    <td> Monday 4 April 2023</td>
                                    <td>file.txt</td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-bottom">
                        <div class="dataTable-info">Showing 1 to 5 of 5 entries</div>
                        <nav class="dataTable-pagination">
                            <ul class="dataTable-pagination-list"></ul>
                        </nav>
                    </div>
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