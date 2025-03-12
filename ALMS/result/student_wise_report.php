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
      .fixed-header {
            position: sticky;
            top: 0;
            background-color: #000000; /* Change this color code to the desired shade of black */
            z-index: 1;
        }
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
            <div class="row">
                <div class="card ms-3 col-11 m-1 ">

                    <div class="card-body">

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Report</button>
                            </li>

                        </ul>
                    </div>

                    <!-- First Tab -->
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                                <table class=" ms-4 table table-bordered">
                                    <thead class="fixed-header text-light">
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Quiz Name</th>
                                            <th>Quiz Date</th>
                                            <th>Quiz Total Marks</th>
                                            <th>Quiz Obtained Marks</th>
                                            <th>Improvement Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                     
                                        if (isset($_POST['enNumber']) && !empty($_POST['enNumber'])) {
                                            $enrollmentNumber = $_POST['enNumber'];

                                            $sql = "WITH QuizResults AS (
                                                SELECT
                                                    qrs.stud_id AS Student_ID,
                                                    q.qui_name AS Quiz_Name,
                                                    qrs.result_date AS Quiz_Date,
                                                    q.qui_total_marks AS Quiz_Total_Marks,
                                                    qrs.obtn_marks AS Quiz_Obtained_Marks,
                                                    (
                                                        SELECT MAX(qrs2.obtn_marks)
                                                        FROM quiz_result qrs2
                                                        WHERE qrs2.stud_id = qrs.stud_id AND qrs2.qui_id < qrs.qui_id
                                                    ) AS Previous_Marks,
                                                    ROW_NUMBER() OVER (PARTITION BY qrs.stud_id ORDER BY qrs.result_date) AS Quiz_Number
                                                FROM
                                                    quiz q
                                                JOIN
                                                    quiz_result qrs ON qrs.qui_id = q.qui_id
                                                WHERE
                                                    qrs.stud_id = '$enrollmentNumber'
                                            )
                                            SELECT
                                                Student_ID,
                                                Quiz_Name,
                                                Quiz_Date,
                                                Quiz_Total_Marks,
                                                Quiz_Obtained_Marks,
                                                CASE
                                                    WHEN Quiz_Number = 1 THEN 'N/A'
                                                    WHEN Previous_Marks IS NULL THEN 'No Change'
                                                    WHEN Previous_Marks < Quiz_Obtained_Marks THEN 'Improved'
                                                    WHEN Previous_Marks > Quiz_Obtained_Marks THEN 'Decreased'
                                                    ELSE 'No Change'
                                                END AS Improvement_Status
                                            FROM
                                                QuizResults
                                            ORDER BY
                                                Student_ID, Quiz_Date;";
                                        } 
                                        else  {
                                            $sql = "WITH QuizResults AS (
                                            SELECT
                                                qrs.stud_id AS Student_ID,
                                                q.qui_name AS Quiz_Name,
                                                qrs.result_date AS Quiz_Date,
                                                q.qui_total_marks AS Quiz_Total_Marks,
                                                qrs.obtn_marks AS Quiz_Obtained_Marks,
                                                (
                                                    SELECT MAX(qrs2.obtn_marks)
                                                    FROM quiz_result qrs2
                                                    WHERE qrs2.stud_id = qrs.stud_id AND qrs2.qui_id < qrs.qui_id
                                                ) AS Previous_Marks,
                                                ROW_NUMBER() OVER (PARTITION BY qrs.stud_id ORDER BY qrs.result_date) AS Quiz_Number
                                            FROM
                                                quiz q
                                            JOIN
                                                quiz_result qrs ON qrs.qui_id = q.qui_id
                                        )
                                        SELECT
                                            Student_ID,
                                            Quiz_Name,
                                            Quiz_Date,
                                            Quiz_Total_Marks,
                                            Quiz_Obtained_Marks,
                                            CASE
                                                WHEN Quiz_Number = 1 THEN 'N/A'
                                                WHEN Previous_Marks IS NULL THEN 'No Change'
                                                WHEN Previous_Marks < Quiz_Obtained_Marks THEN 'Improved'
                                                WHEN Previous_Marks > Quiz_Obtained_Marks THEN 'Decreased'
                                                ELSE 'No Change'
                                            END AS Improvement_Status
                                        FROM
                                            QuizResults
                                        ORDER BY
                                            Student_ID, Quiz_Date;";
                                        }
                                        $result = mysqli_query($conn, $sql);

                                        // Check if there are any results
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>{$row['Student_ID']}</td>";
                                                echo "<td>{$row['Quiz_Name']}</td>";
                                                echo "<td>{$row['Quiz_Date']}</td>";
                                                echo "<td>{$row['Quiz_Total_Marks']}</td>";
                                                echo "<td>{$row['Quiz_Obtained_Marks']}</td>";
                                                echo "<td>{$row['Improvement_Status']}</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No results found</td></tr>";
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
        <!-- Add this script at the end of your HTML body tag -->
        <!-- Add this script at the end of your HTML body tag -->


    </body>

    <?php require_once "../js.php" ?>
    </html>