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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
            color: aliceblue;
            background-color: #1d1d1d;
            text-align: center;
            padding: 8px;
        }

        td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
        }
    </style>
</head>


<body style="background-color: #f2f2f2;">
    <div class="row">
        <div class="card ms-3 col-12 mb-4 ">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-center">Date wise attendance report</h5>
            </div>
            <div class="row">
                <div class="col-4">
                    <h6 class="card-title ms-3">Category :
                        <?php echo $categoryName; ?>
                        </h5>
                </div>
                <div class="col-4">
                    <h6>Course :
                        <?php echo $courseName; ?>
                    </h6>
                </div>
                <div class="col-4">
                    <h6 class="card-title d-flex justify-content-center">From date :
                        <?php echo $reportStartDate . " to " . $reportEndDate; ?>
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">

        <div>

            <?php
            require_once("../header.php");
            require_once("../sidebar.php");
            require_once "../connection.php";
            $sql = "SELECT stu.stud_id, att_date, TIME_FORMAT(att_time, '%r') as att_time, (CASE WHEN att_status = 1 THEN 'P' ELSE 'A' END) AS presentORabsent
            FROM attendance att, student stu, category cat, course cou
            WHERE  cou.cse_id = $reportCourse 
            AND cat.cat_id = cou.cat_id
            AND att.cse_id = cou.cse_id
            AND DATE(att_date) BETWEEN  " . date('Ymd', strtotime($reportStartDate)) . " AND  " . date('Ymd', strtotime($reportEndDate)) .
                " AND att.stud_id = stu.stud_id order by att_date asc, TIME_FORMAT(att_time, '%r') desc;";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                echo "<div style='display:flex; justify-content:center; align-items:center;'><table id='myTable' style='width:75%'>
                <tr>
                    <th>Attendance Date</th>
                    <th>Attendance Time</th>
                    <th>Enrollment No.</th>
                    <th>Attendance Status</th>
                </tr>
                ";
                $dt = null;
                $te = null;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$row['att_date']}</td>
                    <td>{$row['att_time']}</td>
                    
                    ";
                    if ($row['presentORabsent'] == "P") {
                        echo "<td style='background-color:rgba(0,255,0,0.1);'>{$row['stud_id']}</td><td style='background-color:rgba(0,255,0,0.1);'>{$row['presentORabsent']}</td>";
                    } else {
                        echo "<td style='background-color:rgba(255,0,0,0.1);'>{$row['stud_id']}</td><td style='background-color:rgba(255,0,0,0.1);'>{$row['presentORabsent']}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table></div>";
            } else {
                echo "<h6 class='text-center'>No results found</h6>";
            }

            ?>
        </div>
        <div class="text-center mt-3">


            <a href='../attendance/attendance.php'>
                <div class="btn btn-success col-1">Back</div>
            </a>

        </div>
    </div>
    </div>


    <script src="assets/js/main.js"></script>
    <script src="../assets/jquery/jquery-3.6.4.min.js"></script>
    <script src="../assets/jquery/jquery.table.marge.js"></script>
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script src="asset/js/jquery-3.6.0.min.js"></script>
    <script src="asset/js/datatables.min.js"></script>
    <script src="asset/js/pdfmake.min.js"></script>
    <script src="asset/js/vfs_fonts.js"></script>
    <script src="asset/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').margetable({
                type: 2,
                colindex: [0, 1] // column 1, 2
            });
        });

    </script>
</body>

</html>