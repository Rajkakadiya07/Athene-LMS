        <!DOCTYPE html>
        <html lang="en">
        <?php
        extract($_POST);
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


            <link href="../assets/css/style.css" rel="stylesheet">

            <style>
                .card {
                    margin-top: 40px;
                }


                .table-container {
                    height: 400px;
                    overflow-y: auto;
                }

                .fixed-header {
            position: sticky;
            top: 0;
            background-color: #000000; /* Change this color code to the desired shade of black */
            z-index: 1;
        }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th,
                td {
                    text-align: center;
                    padding: 8px;
                    border: 1px solid black;
                }

                .small-table {
                    font-size: 13px;
                    /* Adjust font size as needed */
                    padding: 4px;
                    /* Adjust padding as needed */
                }

                .table-container {
        height: 500px; /* Set the desired height for the table container */
        width: 100%; /* Set the width of the table container */
        overflow-y: auto; /* Add vertical scrollbar if the content overflows */
    }
            </style>
        </head>


        <body>

            <?php
            session_start();
            require_once("../header.php");
            require_once("../sidebar.php");
            require("../connection.php");
            ?>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $minMarks = mysqli_real_escape_string($conn, $_POST['minMarks']);
                $maxMarks = mysqli_real_escape_string($conn, $_POST['maxMarks']);
                $activityType = mysqli_real_escape_string($conn, $_POST['activityType']);

                $query = "";

                if ($activityType == 'quiz') {
                    $query = "SELECT
                                qr.stud_id,
                                qr.obtn_marks AS quiz_marks,
                                qr.result_date AS quiz_date,
                                q.qui_name AS quiz_name,
                                q.qui_total_marks AS quiz_total_marks
                            FROM
                                quiz_result qr
                            JOIN
                                quiz q ON qr.qui_id = q.qui_id
                            WHERE
                                qr.obtn_marks BETWEEN $minMarks AND $maxMarks";
                } elseif ($activityType == 'assignment') {
                    $query = "SELECT
                                a.stud_id,
                                a.agn_obtained_marks AS assignment_marks,
                                a.agn_submission_date_time AS assignment_submission_date,
                                ass.agn_name AS assignment_name,
                                ass.agn_total_marks AS assignment_total_marks
                            FROM
                                assignment_submission a
                            LEFT JOIN
                                assignment ass ON a.agn_id = ass.agn_id
                            WHERE
                                a.agn_obtained_marks BETWEEN $minMarks AND $maxMarks
                                AND a.agn_submission_status = 1
                            ";
                } else {
                    echo "Invalid activity type";
                    exit();
                }

                $result = mysqli_query($conn, $query);

                if ($result) {
                    $report = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $report[] = $row;
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Invalid request";
                exit();
            }

            mysqli_close($conn);
            ?>
            <main id="main" class="main">


                <div class="row">
                    <div class="card ms-3 col-11 m-1 ">

                        <div class="card-body">
                            <h5 class="card-title">Student Marks Report </h5>

                            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Report</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2" id="borderedTabContent">
                                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">

                                    <div class="row">
                                        <div class="col-12 ">
                                        <div class="table-container">
                                            <table class="  ms-4 table table-bordered">
                                                <thead class="fixed-header text-light">
                                                    <tr>
                                                        <th>Student ID</th>
                                                        <?php
                                                        if (isset($report) && !empty($report)) {
                                                            $firstRow = reset($report); // Get the first row of the report data
                                                            if (isset($firstRow['quiz_marks'])) {
                                                                echo "<th>Quiz Name</th>";
                                                                echo "<th>Quiz Date</th>";
                                                                echo "<th>Quiz Total Marks</th>";
                                                                echo "<th>Quiz Obtained Marks</th>";
                                                            } elseif (isset($firstRow['assignment_marks'])) {
                                                                echo "<th>Assignment Name</th>";
                                                                echo "<th>Assignment Total Marks</th>";
                                                                echo "<th>Assignment Marks</th>";
                                                                echo "<th>Assignment Submission Date</th>";
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($report) && !empty($report)) {
                                                        foreach ($report as $row) {
                                                            echo "<tr>";
                                                            echo "<td>{$row['stud_id']}</td>";
                                                            if (isset($row['quiz_marks'])) {
                                                                echo "<td>{$row['quiz_name']}</td>";
                                                                echo "<td>{$row['quiz_date']}</td>";
                                                                echo "<td>{$row['quiz_total_marks']}</td>";
                                                                echo "<td>{$row['quiz_marks']}</td>";
                                                            } elseif (isset($row['assignment_marks'])) {
                                                                echo "<td>{$row['assignment_name']}</td>";
                                                                echo "<td>{$row['assignment_total_marks']}</td>";
                                                                echo "<td>{$row['assignment_marks']}</td>";
                                                                echo "<td>{$row['assignment_submission_date']}</td>";
                                                            }
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5'>No data found</td></tr>";
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
                </div>
                </div>
                </div>
                </div>
            </main>
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

            <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
            <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../assets/vendor/chart.js/chart.umd.js"></script>
            <script src="../assets/vendor/echarts/echarts.min.js"></script>
            <script src="../assets/vendor/quill/quill.min.js"></script>
            <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
            
            <script src="../assets/vendor/php-email-form/validate.js"></script>

            <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>


            <script src="../assets/js/main.js"></script>
            

        </body>
        <?php require_once "../js.php" ?>
        </html>