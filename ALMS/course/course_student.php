<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include "../css.php"; ?>
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }

        .card-image-top {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .card-hover:hover {
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            /* Add a subtle downward shadow */
            z-index: 1;
            /* Bring the card above other elements */
            transition: 300ms;
        }.card-body .place-title,
.card-body .text-secondary {
    font-size: 18px; /* Adjust the font size as needed */
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}

    </style>
</head>

<body>
<?php
    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-error-warning-line text-primary h2"></i>
                        <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                        <p class="mt-2 text-dark" id="modalShortName"></p>
                        <p class="mt-2 text-dark" id="modalCourseName"></p>
                        <button type="button" class="btn btn-secondary my-2 close">Close</button>
                        <a class="icon" id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2"
                                data-dismiss="modal">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Course</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">View Course</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <!-- course add space-->
                            <?php

                            $sql = "SELECT * FROM course, course_student, student where course.cse_id = course_student.cse_id and course_student.stud_id = student.stud_id and student.stud_id = '{$_SESSION['userid']}';";

                            $result = mysqli_query($conn, $sql);
                            if (!empty($result->num_rows) && $result->num_rows > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {

                                    if ($i % 2 == 1) {
                                        echo "<div class='row mt-3'>";
                                    }

                                    if (empty($row['cse_image'])) {
                                        $image = "<i class='bi bi-journal-text text-dark' style='font-size:100px;padding-left:20px;'></i>";
                                    } else {
                                        $image = "<img src='{$row['cse_image']}' width='100px' alt='{$row['cse_full_name']}'>";
                                    }
                                    
                                    echo "
                                    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                                    <div class='card card-hover'>
                                        <div class='filter'></div>
                                        <div class='row no-gutters'>
                                            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3 d-flex justify-content-center align-items-center'>
                                                <div class='card-icon'>
                                                    $image
                                                </div>
                                            </div>
                                            <div class='col-lg-9 col-md-9 col-sm-9 col-xs-9'>
                                                <div class='card-body'>
                                                    <h5 class='card-title'></h5>
                                                    <h5 class='place-card__content_header'>
                                                        <a href='course_view.php?cseId={$row['cse_id']}'>
                                                            <p class='text-primary place-title mb-1'>{$row['cse_full_name']}</p>
                                                            <p class='text-secondary text-truncate mb-1'>{$row['cse_short_name']}</p>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 ";

                                    if ($i % 2 == 0) {
                                        echo "</div>";
                                    }
                                    $i++;
                                }
                            } else {
                                echo "<h5 class='text-secondary my-3 text-center'>No courses are available</h5>";
                            }


                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End  Tab -->

        </div>
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
        $(document).ready(function () {

            function todayDate() {
                let d = new Date();
                let currDate = d.getDate();
                let currMonth = d.getMonth() + 1;
                let currYear = d.getFullYear();
                today = currYear + "-" + ((currMonth < 10) ? '0' + currMonth : currMonth) + "-" + ((currDate < 10) ? '0' + currDate : currDate);
                return today
            }
            $('#startdate').val(todayDate());

            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();
                // category = document.getElementById('csecategory').value;
                // fullname = document.getElementById('csename').value;
                // desc = document.getElementById('csedesc').value;
                // startdate = document.getElementById('csestartdate').value;
                // enddate = document.getElementById('cseenddate').value;

                // if (fullname == "") {
                //     return false;
                // } else if (desc == "") {
                //     return false;
                // } else if (startdate == "") {
                //     return false;
                // } else if (enddate == "") {
                //     return false;
                // }

                form.submit();
            });


            $('.del').click(function (e) {
                console.log(e.target);
                $('#mod1').modal('show');
                courseName = $(e.target).attr('full');
                link = $(e.target).attr('link');
                console.log(courseName + link);
                $("#modalCourseName").html(courseName);
                $("#modalDeleteBtn").attr("href", link);

            });
            $('.close').click(function () {
                $('#mod1').modal('hide');
            });

            // Remove warnings after altered inputs

            $('input').on('input', function (e) {
                if (e.target.id == "shortname") {
                    $('#categoryShortName').hide();
                } else if (e.target.id == "fullname") {
                    $('#categoryFullName').hide();
                }
            });


        });
    </script>
     <?php require_once "../js.php" ?>
</body>


</html>