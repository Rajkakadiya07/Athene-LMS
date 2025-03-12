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
        <div class="row" style="color: black;">
            <div class="card ms-3 col-11 m-1">
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table class='table table-bordered' id='myTable'>
                        <thead>
                            <tr>
                                <th scope='col'>Course</th>
                                <th scope='col'>Name</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Activty</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            require_once "../connection.php";

                            if (isset($_GET['course'])) {
                                $sql = "SELECT cse_full_name, id, title, date, activity 
            FROM (
                SELECT cse_full_name, agn_id as id, agn_name as title, agn_start_date as date, 'assignment' as activity 
                FROM assignment, course 
                WHERE assignment.cse_id = course.cse_id AND course.cse_id = {$_GET['course']}
                
                UNION ALL
                
                SELECT cse_full_name, qui_id as id, qui_name as title, qui_start_time as date, 'quiz' as activity 
                FROM quiz, course 
                WHERE quiz.cse_id = course.cse_id AND course.cse_id = {$_GET['course']}
            ) as combine_table";

                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                         <td>$row[cse_full_name]</td>
                         ";
                                            if ($row['activity'] == "assignment") {
                                                echo "<td><a href='student_wise_result.php?agn_id={$row['id']}&activity={$row['activity']}'>$row[title]</a></td>";
                                            } else if ($row['activity'] == "quiz") {
                                                echo "<td><a href='student_wise_result.php?qui_id={$row['id']}&activity={$row['activity']}'>$row[title]</a></td>";
                                            }
                                            echo "
                     <td>$row[date]</td>
                     <td>$row[activity]</td>
                 </tr>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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
    <script src="../assets/jquery/datatables.min.js"></script>

    <script>
        let table1 = new DataTable('#myTable');
    </script>
</body>
<?php require_once "../js.php" ?>

</html>