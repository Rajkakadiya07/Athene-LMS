<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
        /* Media query for tablets */
@media (max-width: 768px) {
    /* Add styles specific for tablets here */
    /* You can adjust font sizes, paddings, margins, etc. */
}

/* Media query for mobile devices */
@media (max-width: 576px) {
    /* Add styles specific for mobile devices here */
    /* You can further adjust font sizes, paddings, margins, etc. */
    body {
        font-size: 14px; /* Example: Decrease the default font size for better readability on smaller screens */
    }
    .card-title {
        font-size: 18px; /* Example: Adjust the card title font size for smaller screens */
    }
    .modal-dialog {
        max-width: 90%; /* Example: Make the modal content occupy 90% of the screen width on mobile */
    }
    /* Add more specific styles as needed for a better mobile experience */
}
    
/* Media query for small screens */
@media (max-width: 767px) {
    .card {
        width: 90%; /* Make the card full width on small screens */
    }

    .card-body {
        padding: 1rem; /* Adjust padding inside the card body */
    }

    .card-title {
        font-size: 1.25rem; /* Adjust the card title font size */
    }

    .btn-primary {
        width: 100%; /* Make the button full width on small screens */
        margin-bottom: 0.5rem; /* Add some bottom margin between buttons */
    }

    /* Adjust other button styles if necessary */
}
.modal-dialog {
  position: fixed;
  margin: auto;
  margin-top: 20px;
  width: 90%; /* Adjust the width as needed */
  height: auto;
  right: 0;
  left: 0;
}

/* Media query for smaller screens (e.g., tablets) */
@media (max-width: 768px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 30px); /* Set max height for the modal */
  }
}

/* Media query for even smaller screens (e.g., mobile phones) */
@media (max-width: 576px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for even smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 15px); /* Set max height for the modal */
  }
}

    </style>
</head>


<body>
    <?php


    date_default_timezone_set('Asia/Kolkata');
    require_once "../connection.php";

    require_once "../sidebar.php";
    require_once "../header.php";

    $sql = "SELECT * FROM poll WHERE poll_id = '{$_GET['pollId']}'";
    $result = mysqli_query($conn, $sql);
    echo $result->num_rows;
    if ($result->num_rows > 0) {
        $_SESSION['POLL'] = $result->fetch_assoc();
    } else {
        die("<h5>Please refresh page</h5>");
    }
    ?>


    <main id="main" class="main ps-0">

        <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="ri-error-warning-line text-primary h2"></i>
                            <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                            <p class="mt-2 text-dark" id="modalCourseName">
                                <?= $_SESSION['POLL']['poll_name'] ?>
                            </p>
                            <button type="button" class="btn btn-secondary my-2 close">Close</button>
                            <a class="icon" href="poll_delete.php?pollId=<?= $_SESSION['POLL']['poll_id'] ?>"
                                id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2"
                                    data-dismiss="modal">Delete</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagetitle ms-2">
            <?php
            if (!empty($_SESSION['course'])) {
                echo "<nav>
                <ol class='breadcrumb'>
                    <li class='breadcrumb-item'><a href=''>Course</a></li>
                    <li class='breadcrumb-item active'><a href='course_view.php?cseId={$_SESSION['course']['cse_id']}'>{$_SESSION['course']['cse_full_name']}</a></li>    
                    <li class='breadcrumb-item active'><a href=''>{$_SESSION['POLL']['poll_name']}</a></li>
                </ol>
            </nav>";
            }
            ?>
        </div>
        <!-- End Page Title -->

        <div class="card ms-4 col-11">
            <div class="card-body">
                <div class="row">
                    <div class="col-10  ">
                        <h5 class="card-title"><i class="ri-clipboard-fill h5 align-middle me-1"></i>
                            <?php echo $_SESSION['POLL']['poll_name']; ?>
                        </h5>
                    </div>
                    <?php
                    if ($_SESSION['usertype'] != "Student") {
                        echo "
                            <div class='col-4 mt-3'>
                            <button id='del' class='btn btn-primary'>Delete</button>
                            </div>
                            ";
                    }
                    // <a href='learning_material_edit.php'><button class='btn btn-primary'>Edit</button></a>
                    // Above line is for edit button if needed
                    ?>
                </div>

                <div class="mb-4"></div>
                <span class="text-dark h6"><b>Created on: </b>
                    <?php echo date("d-m-Y h:i:s A", strtotime($_SESSION['POLL']['poll_date_time'])); ?>
                </span>
                <hr class="text-dark">

                <!-- Poll Code started here  -->
                <div class="container-fluid pe-5">
                    <h5 class="text-dark">
                        <b>Question:</b>
                        <?= $_SESSION['POLL']['poll_text']; ?>
                    </h5>

                    <?php
                    $answers = null;
                    $sql = "select * from poll_answers where poll_id = {$_SESSION['POLL']['poll_id']}";
                    if ($result = mysqli_query($conn, $sql)) {
                        if ($result->num_rows > 0) {
                            $cnt = 0;
                            while ($data = $result->fetch_assoc()) {
                                $count_sql = "SELECT count(*) as count from student_poll_answers where poll_answer_id = {$data['poll_answer_id']}";
                                if ($count_result = mysqli_query($conn, $count_sql)) {
                                    $data1 = $count_result->fetch_assoc();
                                    echo "<form action='poll_answer_submit.php' method='post'>
                                           <div class='container-fluid mt-3 border border-3 rounded-start border-primary px-5 py-2'>
                                            <div class='container-fluid d-flex align-items-center py-1'>
                                               <input type='radio' class='form-check-input' id='opt" . $cnt . "' name='option' value='{$data['poll_answer_id']}''>
                                               <label for='opt" . $cnt . "' class='text-dark ps-2'>{$data['poll_answer']}</label>
                                            </div>";
                                    if ($data1['count'] > 0) {
                                        echo "<div class='progress mt-3'>
                                                <div class='progress-bar progress-bar bg-primary' role='progressbar' style='width: 50%;font-size:15px;' data-option='{$data1['count']}' aria-valuenow='5' aria-valuemin='0' aria-valuemax='100'></div>
                                                </div>";
                                    } else {
                                        echo "<div class='progress mt-3'>
                                        <div class='progress-bar progress-bar bg-danger' role='progressbar' style='width: 100%' data-option='{$data1['count']}' aria-valuenow='5' aria-valuemin='0' aria-valuemax='100'></div>
                                        </div>";
                                    }
                                    echo "</div>";
                                }
                                $cnt++;
                            }
                            $attempted = null;
                            $option_id = null;
                            $sql2 = "select * from student_poll_answers, poll_answers where student_poll_answers.poll_answer_id = poll_answers.poll_answer_id and poll_answers.poll_id = {$_SESSION['POLL']['poll_id']} and stud_id = '{$_SESSION['userid']}'";
                            // echo $sql2;
                            if ($result = mysqli_query($conn, $sql2)) {
                                $data = $result->fetch_assoc();
                                $option_id = $data['poll_answer_id'] ?? null;
                                $attempted = true;
                            } else {
                                $attempted = false;
                            }
                            // echo $attempted . "attempted"; 
                            // I dont know why its value is assign as 1
                            ?>
                            <script>
                                //Code to select option which is selected by student
                                // console.log(document.querySelector('input[type="radio"][value="' + <?= $option_id; ?> +'"]'));
                                optionid = <?= $option_id; ?>;
                                console.log(optionid);
                                if (optionid != null) {
                                    document.querySelector('input[type="radio"][value="' + optionid + '"]').setAttribute("checked", "true");
                                }
                            </script>
                            <?php
                            if ($_SESSION['usertype'] == "Student" && empty($option_id)) {
                                echo "
                            <div class='mt-3'>
                                <button type='submit' class='btn btn-primary'>Submit</button>
                            </div>
                            ";
                            }
                            echo "</form>";
                        }
                    }

                    ?>
                </div>

                <!-- Poll Code Ended here -->
            </div>
        </div>
    </main>





    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>



    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
    <script>
        $(document).ready(function () {

            $('#del').click(function (e) {
                $('#mod1').modal('show');
            });

            $('.close').click(function () {
                $('#mod1').modal('hide');
            });
        });



        document.addEventListener("DOMContentLoaded", function () {
            // Get all radio buttons with the name "option"
            // const progressBars = document.querySelectorAll('.progress-bar');
            const progressBars = document.querySelectorAll('[role="progressbar"]');
            // console.log("query selector all progress bars" + progressBars);
            // Initialize variables for total value and percentage
            let totalValue = 0;
            // console.log("Total value before calculation : " + totalValue);

            // Calculate the total value and update the percentages
            progressBars.forEach((progressBar) => {
                // console.log(progressBar);

                totalValue += parseInt(progressBar.getAttribute("data-option"));
            });
            // console.log("Total value after calculation : " + totalValue);
            // Update the percentages
            progressBars.forEach((progressBar, index) => {
                const percentage1 = (parseInt(progressBar.getAttribute("data-option")) / totalValue) * 100;
                const percentage = percentage1.toFixed(2);
                // console.log("Percentage of each : " + percentage);

                if (percentage != "NaN" && percentage != 0) {
                    progressBar.setAttribute("style", "width:" + percentage + "%")
                    progressBar.innerHTML = "<p class='text-white' style='padding-top:15px;font-size:15px'>" + percentage + "%</p>";
                } else {
                    progressBar.innerHTML = "<p class='text-white' style='padding-top:15px;font-size:15px'>0%</p>";

                }
            });


        });



    </script>


</body>

</html>