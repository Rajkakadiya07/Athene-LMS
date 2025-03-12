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
/* Default styles for modal */
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

  /* Additional responsive styles for smaller screens can be added here */
}

/* Media query for phones */
@media (max-width: 576px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for phones */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 15px); /* Set max height for the modal */
  }

  /* Additional responsive styles for phones can be added here */

  /* Example: Adjust font sizes or paddings/margins for smaller screens */
  body {
    font-size: 14px;
  }

  /* Example: Adjust padding/margin for specific elements */
  .card-body {
    padding: 10px;
  }

  /* Example: Hide certain elements on phones */
  .hide-on-mobile {
    display: none;
  }
}
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
    

img {
    max-width: 100%;
    height: auto;
}
/* Default styles for modal */
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

    $sql = "SELECT * FROM assignment WHERE agn_id = '{$_GET['agnId']}'";
    $result = mysqli_query($conn, $sql);
    echo $result->num_rows;
    if ($result->num_rows > 0) {
        $_SESSION['assignment'] = $result->fetch_assoc();
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
                                <?= $_SESSION['assignment']['agn_name'] ?>
                            </p>
                            <button type="button" class="btn btn-secondary my-2 close">Close</button>
                            <a class="icon" href="delete_assignment.php?agnId=<?= $_SESSION['assignment']['agn_id'] ?>"
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
                    <li class='breadcrumb-item active'><a href='./Admin.php'>{$_SESSION['assignment']['agn_name']}</a></li>
                </ol>
            </nav>";
            }
            ?>
        </div>
        <!-- End Page Title -->

        <div class="card ms-4 col-11 col-md-11">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 col-sm-12 mb-3">
                        <h5 class="card-title"><i class="ri-clipboard-fill h5 align-middle me-1"></i>
                            <?php echo $_SESSION['assignment']['agn_name']; ?>
                        </h5>
                    </div>
                    <?php
                    if ($_SESSION['usertype'] != "Student") {
                        echo "
                            <div class='col-md-4 col-sm-12 mt-3'>";
                        if ($_SESSION['assignment']['agn_disable_submission'] == 0) {
                            echo "<a href='disable_submission.php?disable=1'><button class='btn btn-primary'>Disable submission</button></a>";
                        } else {
                            echo "<a href='disable_submission.php?enable=1'><button class='btn btn-primary'>Enable submission</button></a>";
                        }
                        echo "
                            <a href='assignment_edit.php'><button class='btn btn-primary'>Edit</button></a>
                            <button id='del' class='btn btn-primary'>Delete</button>
                            </div>
                            ";
                    }
                    ?>
                </div>

                <div class="mb-4"></div>
                <span class="text-dark h6"><b>Opened: </b>
                    <?php echo date("d-m-Y h:i:s A", strtotime($_SESSION['assignment']['agn_start_date'])); ?>
                </span>
                <!--  <hr class="text-dark"> -->
                <br>
                <span class="text-dark h6"><b>Due: </b>
                    <?php echo date("d-m-Y h:i:s A", strtotime($_SESSION['assignment']['agn_end_date'])); ?>
                </span>
                <br>
                <span class="text-dark h6"><b>Marks: </b>
                    <?php echo $_SESSION['assignment']['agn_total_marks']; ?>
                </span>
                <hr class="text-dark">
                <h5 class="text-dark">Description</h5>
                <span class="text-dark h6">
                    <?php echo nl2br($_SESSION['assignment']['agn_desc']); ?>
                </span>


                <?php
                if (!empty($_SESSION['assignment']['agn_file'])) {
                    echo "<hr class='text-dark'><h5 class='text-dark'>Attached file</h5>";
                    echo "<span class='text-dark  h6'>" . basename($_SESSION['assignment']['agn_file']) . "<br> <a class='' href='./download.php?path={$_SESSION['assignment']['agn_file']}'>
                    <button type='button' class='mt-2 btn btn-primary btn-sm'>Download</button>
                    </a></span>";
                    if ($_SESSION['usertype'] == "Teacher" || $_SESSION['usertype'] == "Admin") {
                        echo "<a  href='delete_assignment_file.php?path={$_SESSION['assignment']['agn_file']}'>Remove file</a>";
                    }
                    echo "<hr class='text-dark'>";
                } else {
                    if ($_SESSION['usertype'] != "Student") {
                        echo "<hr class='text-dark'><h5 class='text-dark'>Upload file</h5>";

                        echo "
                        <form action='update_assignment_file.php' method='post' enctype='multipart/form-data'>
                        <div class='row mb-3'>
                          <label class='col-md-2 col-form-label text-dark' for='short_description'>Add File</label>
                          <div class='col-md-10 d-flex'>
                            <input type='file' class='form-control w-50' id='course_title' name='attachment' required>
                            <input type='submit' class='btn btn-primary ms-5' value='Upload'>
                          </div>
                        </div></form>";
                    }
                }
                ?>
            </div>
        </div>


        <?php
        if ($_SESSION['usertype'] == "Student") {
            require_once "../connection.php";
            $sql = "SELECT * FROM student, assignment_submission where student.stud_id = assignment_submission.stud_id and student.stud_id = {$_SESSION['userid']} and assignment_submission.agn_id = {$_SESSION['assignment']['agn_id']}";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
            } else {
                exit("<h5 class='text-dark'>You are not eligible to add this submission </h5>");
            }
            $assignmentQuery = "SELECT * FROM assignment WHERE agn_id = {$_SESSION['assignment']['agn_id']}";

            if ($assignment = mysqli_query($conn, $assignmentQuery)) {
                if ($assignment->num_rows > 0) {
                    $assignment = $assignment->fetch_assoc();
                    $end = $assignment['agn_end_date'];
                } else {
                    $end = "now";
                }
            }

            $start_date = strtotime(date("Y-m-d h:i:s A", time()));
            $end_date = strtotime($end);

            // Calculate the interval in seconds
            $interval = $end_date - $start_date;

            // Convert the interval to days, hours, minutes, and seconds
            $days = floor($interval / (60 * 60 * 24));
            $hours = floor(($interval - ($days * 60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
            $seconds = $interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60);

            // Print the interval
            if ($days < 0 || $hours == 0 && $minutes == 0 && $seconds == 0) {
                $timeRemain = "<span class='text-danger'> Deadline over </span>";
            } else {
                $timeRemain = ($days != 0) ? $days . " days " : "";
                $timeRemain .= $hours . ' hours ' . $minutes . ' minutes ' . $seconds . ' seconds';
            }

            if ($days == 0 && $hours == 0 && $minutes == 0 && $seconds == 0) {
                $deadline = true;
            }

            echo "
            <div class='card ms-4 col-11'>
            <div class='card-body'>
            <h5 class='card-title'>Submission status</h5>
            <div class='table-responsive'>
            <table class='table'>
            <tbody>
            <tr>
            <th scope='row'>Submission status</th>
            ";
            if (!empty($data['agn_submission_status']) && $data['agn_submission_status'] == 1) {
                ;
                echo "<td class='table-success'>Submitted</td>";
            } else {
                echo "<td class='table-danger'>Not submitted</td>";
            }
            echo "
            </tr>
            <tr>
            <th scope='row'>Grading status</th> 
            ";
            if ($data['agn_obtained_marks'] != null || $data['agn_obtained_marks'] != 0) {
                ;
                echo "<td class='table-success'>Graded</td>";
            } else {
                echo "<td class='table-danger'>Not graded</td>";
            }
            echo "
            </tr><tr>";
            if (!empty($data['agn_submission_status']) && $data['agn_submission_status'] == 1) {
                ;
            } else {
                echo "<th scope='row'>Time remaining</th>
                <td>$timeRemain</td>";
            }
            echo "           
            </tr>
            <tr>
            <th scope='row'>Submitted date</th>
            <td>";
            if (!empty($data['agn_submission_date_time'])) {
                echo date("d-m-Y h:i:s A", strtotime($data['agn_submission_date_time']));
            } else {
                echo " - ";
            }
            echo "</td>
            </tr>";

            if ($_SESSION['assignment']['agn_disable_submission'] == 0) {

                echo "
            <form action='submit_assignment.php' method='post' enctype='multipart/form-data'>
            <tr>
            <th scope='row'>Submission</th>
            <td>";
                if (!empty($data['agn_submission_status']) && $data['agn_submission_status'] == 1) {
                    $file = "select agn_submission_file from assignment_submission where agn_id={$_SESSION['assignment']['agn_id']} and stud_id = {$_SESSION['userid']}";
                    if ($result = mysqli_query($conn, $file)) {
                        $row = $result->fetch_assoc();
                        echo "<a class='' href='./download.php?path={$row['agn_submission_file']}'><span class='text-primary h6'>" . basename($row['agn_submission_file']) . "</a>";
                        if ($data['agn_obtained_marks'] == null || $data['agn_obtained_marks'] != 0) {
                            echo "<a class='ms-5' href='delete_submission_file.php?path={$row['agn_submission_file']}'>Remove file</a>";
                        }
                    } else {
                        echo "File not found";
                    }
                } else {
                    echo "<input type='file' class='form-control' id='course_title' name='submission' required><br>
                <button type='submit' class='btn btn-primary btn-sm'>Add submission</button>";
                }

                echo "</td>
            </tr>
            </form>";
            } else {
                echo "<tr>
                <th class='text-primary text-center table-warning' colspan=2>Submission disabled</th>
            </tr>";
            }

            echo "</tbody>
            </table>
            </div>
            </div>
            </div>
            ";
        }
        ?>

        <?php
        if ($_SESSION['usertype'] == "Admin" || $_SESSION['usertype'] == "Teacher") {
            require_once "./view_assignment_details.php";
        }
        ?>

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
    </script>

</body>

</html>