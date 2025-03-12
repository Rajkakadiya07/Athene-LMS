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
    <link href="../assets/jquery/datatables.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
/* Default styles for the table */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

/* Styles for smaller screens (phones) */
@media (max-width: 576px) {
    .table {
        font-size: 0.8rem; /* Decrease font size for smaller screens */
    }

    .table thead th,
    .table tbody td {
        padding: 0.4rem; /* Decrease padding for table cells */
    }
}

/* Styles for medium devices (tablets) */
@media (max-width: 768px) {
    .table {
        font-size: 0.9rem; /* Adjust font size for medium screens */
    }
}

/* Styles for larger devices (desktops) */
@media (max-width: 992px) {
    .table {
        font-size: 1rem; /* Default font size for larger screens */
    }
}

/* Additional styles for extra large and larger desktops if needed */

    </style>
</head>

<body>
    <?php
    session_start();
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
            <div class="card ms-3 col-11 m-1 ">
<div class="table-responsive">      
                <div class="card-body mt-3">


                    <table class='table table-borderless datatable' id='myTable'>
                        <thead>
                            <tr>
                                <th scope="col" data-sortable="">ID</th>
                                <th scope="col" data-sortable="">Name</th>
                                <th scope="col" data-sortable="">Status</th>
                                <th scope="col" data-sortable="">Assesment</th>
                                <th scope="col" data-sortable="">Date</th>
                                <th scope="col" data-sortable="">Total Marks</th>
                                <th scope="col" data-sortable="">Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../connection.php";

                            if (isset($_GET['agn_id']) && $_GET['activity'] == "assignment") {
                                // Query for assignment results
                                $sql = "SELECT student.stud_id, stud_name, agn_submission_status, agn_start_date, agn_total_marks, agn_obtained_marks 
            FROM student 
            JOIN assignment_submission ON student.stud_id = assignment_submission.stud_id 
            JOIN assignment ON assignment_submission.agn_id = assignment.agn_id 
            WHERE assignment.agn_id = {$_GET['agn_id']}";

                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows > 0) {        
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                        <td>{$row['stud_id']}</td>
                        <td>{$row['stud_name']}</td>
                        <td>";
                                            if ($row['agn_submission_status'] == 1) {
                                                echo "<span class='badge bg-success'>Submitted</span>";
                                            } else {
                                                echo "<span class='badge bg-danger'>Not submitted</span>";
                                            }
                                            echo "</td>
                        <td>Assignment</td>
                        <td>{$row['agn_start_date']}</td>
                        <td>{$row['agn_total_marks']}</td>";

                                            if ($row['agn_obtained_marks'] === null) {
                                                echo "<td><span class='text-dark'>Not graded</span></td>";
                                            } else {
                                                echo "<td><span class='text-dark'>{$row['agn_obtained_marks']}</span></td>";
                                            }

                                            echo "</tr>";
                                        }
                                    }
                                }
                            } elseif (isset($_GET['qui_id']) && $_GET['activity'] == "quiz") {
                                // Query for quiz results
                                $sql = "SELECT student.stud_id, stud_name, tot_marks, obtn_marks, obtn_grade, result_date
            FROM student
            JOIN quiz_result ON student.stud_id = quiz_result.stud_id
            WHERE quiz_result.qui_id = {$_GET['qui_id']}";

                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                        <td>{$row['stud_id']}</td>
                        <td>{$row['stud_name']}</td>
                        <td><span class='badge bg-success'>Completed</span></td>
                        <td>Quiz</td>
                        <td>{$row['result_date']}</td>
                        <td>{$row['tot_marks']}</td>
                        <td>{$row['obtn_marks']}</td>
                        </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No quiz results available.</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>Error fetching quiz results.</td></tr>";
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
</body>
<?php require_once "../js.php" ?>

</html>