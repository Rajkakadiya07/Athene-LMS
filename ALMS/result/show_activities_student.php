<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    ?>
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
    <link href="../assets/jquery/datatables.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        
        .card-hover:hover {
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            /* Add a subtle downward shadow */
            z-index: 1;
            /* Bring the card above other elements */
            transition: 300ms;
        }

        @media (max-width: 768px) {
            .card {
                margin: 10px 0;
            }
        }

        /* Media query for small screens (up to 767px) */
        @media (max-width: 767px) {
            .nav-tabs {
                flex-direction: column;
            }

            .nav-link {
                width: 100%;
                text-align: left;
            }

            .tab-pane {
                padding: 10px;
            }

            .box,
            .box-2 {
                width: 100%;
                margin: 0;
            }

            .options label,
            .options input {
                width: 100%;
            }
        }

        /* Media query for medium screens (768px to 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                flex: 1;
                text-align: center;
            }
        }

        /* Media query for large screens (992px and above) */
        @media (min-width: 992px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                /* Adjust the width based on your preference */
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .card-title {
                font-size: 1rem;
            }

            .place-card__content_header {
                margin-bottom: 0.5rem;
            }

            .card-icon {
                font-size: 40px;
            }

            .dropdown-menu {
                min-width: 150px;
            }
        }
        thead {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <?php

    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Result</a></li>
                </ol>
            </nav>
        </div>
        <div class="row" style="color:black;">
            <div class="card ms-2 col-11  ">
                <div class="card-body mt-3">
                    <ul class=" mt-3 nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="mat-tab" data-bs-toggle="tab" data-bs-target="#bordered-mat" type="button" role="tab" aria-controls="mat" aria-selected="true"><i class="ri-book-read-fill h5" style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Assignment Status</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cie-tab" data-bs-toggle="tab" data-bs-target="#bordered-cie" type="button" role="tab" aria-controls="cie" aria-selected="false"><i class="bi bi-bar-chart h5" style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Overview</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-mat" role="tabpanel" aria-labelledby="mat-tab">
                            <div class="table-responsive mt-3">
                                <table class='table table-bordered table-hover' id=''>
                                <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Course</th>
                                            <th scope="col">Activity Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Assessment</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Total Marks</th>
                                            <th scope="col">Obtained Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT cse_full_name, agn_name, agn_submission_status, agn_start_date, agn_total_marks, agn_obtained_marks FROM student, course, assignment, assignment_submission WHERE course.cse_id = assignment.cse_id AND student.stud_id = assignment_submission.stud_id AND assignment_submission.agn_id = assignment.agn_id AND assignment_submission.stud_id = '{$_SESSION['userid']}'";

                                        if ($result = mysqli_query($conn, $sql)) {
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                <td>$row[cse_full_name]</td>
                                                <td>$row[agn_name]</td>
                                                <td>";
                                                    if ($row['agn_submission_status'] == 1) {
                                                        echo "<span class='badge bg-success'>Submitted</span>";
                                                    } else {
                                                        echo "<span class='badge bg-danger'>Not submitted</span>";
                                                    }
                                                    echo "</td>
                                                <td>Assignment</td>
                                                <td>$row[agn_start_date]</td>
                                                <td>$row[agn_total_marks]</td>
                                                ";
                                                    if ($row['agn_obtained_marks'] === null) {
                                                        echo "<td><span class='text-dark'>Not graded</span></td>";
                                                    } else {
                                                        echo "<td><span class='text-dark'>$row[agn_obtained_marks]</span></td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="bordered-cie" role="tabpanel" aria-labelledby="cie-tab">
                            <div class="row  mt-3">
                                <div class="table-responsive mt-3">
                                    <table class='table table-bordered table-hover' id=''>
                                        <thead>
                                            <tr>
                                                <th scope="col">Course</th>
                                                <th scope="col">Activity Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total Marks</th>
                                                <th scope="col">Obtained Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           $sql = "SELECT 
                                           cse_full_name, 
                                           COALESCE(agn_name, 'N/A') AS agn_name, 
                                           COALESCE(agn_submission_date_time, 'N/A') AS agn_submission_date_time, 
                                           COALESCE(agn_total_marks, 'N/A') AS agn_total_marks, 
                                           COALESCE(agn_obtained_marks, 'N/A') AS agn_obtained_marks 
                                       FROM 
                                           student, course, assignment, assignment_submission 
                                       WHERE 
                                           course.cse_id = assignment.cse_id 
                                           AND student.stud_id = assignment_submission.stud_id 
                                           AND assignment_submission.agn_id = assignment.agn_id 
                                           AND assignment_submission.stud_id = '{$_SESSION['userid']}'
                                       UNION
                                       SELECT 
                                           cse_full_name, 
                                           COALESCE(qui_name, 'N/A') AS qui_name, 
                                           COALESCE(result_date, 'N/A') AS result_date, 
                                           COALESCE(tot_marks, 'N/A') AS tot_marks, 
                                           COALESCE(obtn_marks, 'N/A') AS obtn_marks 
                                       FROM 
                                           student, course, quiz, quiz_result 
                                       WHERE 
                                           course.cse_id = quiz.cse_id 
                                           AND student.stud_id = quiz_result.stud_id 
                                           AND quiz_result.qui_id = quiz.qui_id 
                                           AND quiz_result.stud_id = '{$_SESSION['userid']}'";

                               if ($result = mysqli_query($conn, $sql)) {
                                   if ($result->num_rows > 0) {
                                       while ($row = $result->fetch_assoc()) {
                                           echo "<tr>
                                               <td>{$row['cse_full_name']}</td>
                                               <td>{$row['agn_name']}</td>
                                               <td>{$row['agn_submission_date_time']}</td>
                                               <td>{$row['agn_total_marks']}</td>
                                               <td>{$row['agn_obtained_marks']}</td>
                                           </tr>";
                                       }
                                   }
                               }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
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
    <script src="../assets/jquery/datatables.min.js"></script>

    <script>
        let table1 = new DataTable('#myTable');
    </script>
    <?php require_once "../js.php" ?>
</body>

</html>