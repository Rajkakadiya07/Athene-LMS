<!DOCTYPE html>
<html lang="en">
<?php
extract($_POST);
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Reports</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="asset/images/favicon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- ========================================================= -->



    <link rel="stylesheet" href="../assets/bt3/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bt3/datatables.min.css">
    <link rel="stylesheet" href="../assets/bt3/style.css">


    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .card {
            margin-top: -99px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            color:aliceblue;
            background-color: #1d1d1d;
            text-align: center;
            padding: 8px;
        }
        td {
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #e0e0e0
        }
    </style>
</head>


<body style="background-color: #f2f2f2;">
    <div class="row">
        <div class="card ms-3 col-12 mb-4 ">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-center">Student absent percentage wise report</h5>
            </div>
            <div class="row">
                <div class="col-4">
                    <h6 class="card-title ms-3">Category : <?php echo $categoryName; ?></h5>
                </div>
                <div class="col-4">
                    <h6>Course : <?php echo $courseName; ?></h6>
                </div>
                <div class="col-4">
                    <h6 class="card-title d-flex justify-content-center">From date : 01-04-2021 to 31-04-2021</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">

        <div>
            <?php
            require_once "../connection.php";
         
            $sdate = date('Ymd', strtotime($reportStartDate));
            $edate = date('Ymd', strtotime($reportEndDate));
            if(empty($days)){
                $days = array("sunday");
            }
            $days1 = implode(",", $days);
            $sql = "CALL GetAttendancePerByDays($reportCategory, $reportCourse, '$sdate', '$edate', '$days1')";

            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                echo "<div style='display:flex; justify-content:center; align-items:center;'><table style='width:75%'>
                <tr>
                    <th>Enrollment No.</th>
                    <th>Present count</th>
                    <th>Absent count</th>
                    <th>Total days</th>
                    <th>Absent Percentage</th>
                </tr>
                ";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$row['stud_id']}</td>
                    <td>{$row['present_count']}</td>
                    <td>{$row['absent_count']}</td>
                    <td> " . $row['absent_count'] + $row['present_count'] ."</td>
                    <td>{$row['absent_per']}</td>
                    </tr>";
                }
                echo "</table></div>";
            } else {
                echo "<h6 class='text-center'>No results found</h6>";
            }

            ?>
        </div>
        <div class="text-center mt-3">
            <a href='../attendance/attendance.php'><div type="submit" name="tps" class="btn btn-success col-1">Back</div></a>
        </div>
    </div>
    </div>


    <script src="assets/js/main.js"></script>

    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script src="asset/js/jquery-3.6.0.min.js"></script>
    <script src="asset/js/datatables.min.js"></script>
    <script src="asset/js/pdfmake.min.js"></script>
    <script src="asset/js/vfs_fonts.js"></script>
    <script src="asset/js/custom.js"></script>

</body>

</html>