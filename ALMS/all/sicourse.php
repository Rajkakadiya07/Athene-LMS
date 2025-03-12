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
</head>


<body>
    <?php
    include 'header.php';
    include 'ssidebar.php'
    ?>
    <main id="main" class="main ps-0">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./stud.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="./stud.php">Dashboard</a></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <div class="card col-12  ">


            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-text h4"></i> ADVANCE WEB DESIGN </h5>
                <div class="d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./stud.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="./scourse.php">Course</a></li>
                            <li class="breadcrumb-item"><a href="#">Calander</a></li>
                            <li class="breadcrumb-item active"><a href="#">Reports</a></li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>


        <div class="card">
            <div class="card-body">
                <!-- <h5 class="card-title">Course</h5> -->

                <!-- Bordered Tabs -->
                <ul class=" mt-3 nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mat-tab" data-bs-toggle="tab" data-bs-target="#bordered-mat" type="button" role="tab" aria-controls="mat" aria-selected="true"><i class="ri-book-read-fill h5"></i> Material</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cie-tab" data-bs-toggle="tab" data-bs-target="#bordered-cie" type="button" role="tab" aria-controls="cie" aria-selected="false"><i class="ri-draft-fill h5"></i> CIE</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assi-tab" data-bs-toggle="tab" data-bs-target="#bordered-assi" type="button" role="tab" aria-controls="assi" aria-selected="false"><i class="ri-clipboard-fill h5"></i> Assaignments</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#bordered-other" type="button" role="tab" aria-controls="other" aria-selected="false"><i class="ri-file-list-2-fill h5"></i> Others</button>
                    </li>
                

                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade show active" id="bordered-mat" role="tabpanel" aria-labelledby="mat-tab">
                        <!-- course add space-->
                        <div class="col-8 mt-2">
                            <div class="card-body">
                                <span class="h6 text-dark"><a href="#" class="text-dark"><i class="ri-discuss-fill h5"></i> Announcements</a></span>
                            </div>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-10">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-book-read-fill h5"></i> HTML 5 pdf</a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-book-read-fill h5"></i> PHP Book</a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-book-read-fill h5"></i> NodeJs Notes</a></li>
                                    <hr>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--second tab-->
                    <div class="tab-pane fade" id="bordered-cie" role="tabpanel" aria-labelledby="cie-tab">
                        <div class="col-8 mt-2">
                            <div class="card-body">
                                <span class="h6 text-dark"><a href="#" class="text-dark"><i class="ri-discuss-fill h5"></i> Announcements</a></span>
                            </div>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-10">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-draft-fill h5"></i> Quiz 1</a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-draft-fill h5"></i> Quiz 2</a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-draft-fill h5"></i> Quiz 3</a></li>

                                    <hr>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- third tab -->
                    <div class="tab-pane fade" id="bordered-assi" role="tabpanel" aria-labelledby="assi-tab">



                        <div class="col-8 mt-2">
                            <div class="card-body">
                                <span class="h6 text-dark"><a href="#" class="text-dark"><i class="ri-discuss-fill h5"></i> Announcements</a></span>
                            </div>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-10">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-clipboard-fill h5"></i> Assaignment 1 </a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-clipboard-fill h5"></i> Assaignment 2 </a></li>
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-clipboard-fill h5"></i> Assaignment 3 </a></li>

                                    <hr>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!-- fourth tab -->
                    <div class="tab-pane fade" id="bordered-other" role="tabpanel" aria-labelledby="other-tab">

                        <div class="col-8 mt-2">
                            <div class="card-body">
                                <span class="h6 text-dark"><a href="#" class="text-dark"><i class="ri-discuss-fill h5"></i> Announcements</a></span>
                            </div>
                        </div>
                        <div class="row  mt-3">
                            <div class="col-10">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-file-list-2-fill h5"></i>Practical 1 </a></li>
                                    <hr>
                                </ul>

                            </div>
                        </div>
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
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {

            $(".edit").click(function() {
                $('#edit').modal('show');
            });
        });
    </script>



    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>

    <script>
        // jQuery functions to hide and show the div
        $(document).ready(function() {
            $("select").change(function() {
                $(this).find("option:selected")
                    .each(function() {
                        var optionValue = $(this).attr("value");
                        if (optionValue) {
                            $(".for").not("." + optionValue).hide();
                            $("." + optionValue).show();
                        } else {
                            $(".for").hide();
                        }
                    });
            }).change();
        });
    </script>

</body>

</html>
<section class="section dashboard">


    <!-- Left side columns -->