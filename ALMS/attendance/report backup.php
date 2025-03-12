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
<body>
<?php

$sdate = strtotime("2021-04-05");
$edate = strtotime("2021-04-30");
$today = time();
$selsub = 1;
$conn = mysqli_connect("localhost", "root", "", "athene_lms");
if (($sdate < $today) && ($edate <= $today) && ($edate >= $sdate)) {
    // echo "sub id".$selsub."<br>";
    // echo "user id".$suid."<br>";
    // echo "starting date:".$sdat." "."ending date:".$edat."<br>";
    // $query_student="SELECT * from student ";

    $query_student = "SELECT student.stud_id, student.stud_name from student INNER JOIN course_student WHERE student.stud_id = course_student.stud_id AND course_student.cse_id  = {$selsub} ORDER BY student.stud_id";


    $stu = $conn->query($query_student);
    $rstu = $stu->fetch_all(MYSQLI_ASSOC);

    // print_r($rstu);
    //	echo "<br><br>--------------<br>";

    echo "<div class='table-responsive text-nowrap'><table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Roll</th>";
    echo "<th>Student's Name</th>";
    for ($eachDate = $sdate; $eachDate <= $edate; $eachDate = $eachDate + 86400) {
        $thisDate = date('d-m-Y', $eachDate);
        $weekday = date("l", $eachDate);
        $normalized_weekday = strtolower($weekday);
        if (($normalized_weekday != "saturday") && ($normalized_weekday != "sunday")) {
            echo "<th>" . $thisDate . "</th>";
        }else{
            // if ($normalized_weekday == "saturday") {
            //     echo "<th>Sat</th>";
            // } else if ($normalized_weekday == "sunday") {
            //     echo "<th>Sun</th>";
            // }
        }
    }
    echo "<th>Present/Total</th>";
    echo "<th>Precentage</th>";;
    echo "</tr>";
    echo "</thead>";
    echo "</tbody>";
    for ($i = 0; $i < count($rstu); $i++) {
        //echo $i."--"."<br>";
        $present = 0;
        $absent = 0;
        $totlec = 0;
        $perc = 0;
        echo "<tr><td>" . $rstu[$i]['stud_id'] . "</td>";
        echo "<td>" . $rstu[$i]['stud_name'] . "</td>";
        $dsid = $rstu[$i]['stud_id'];

        for ($j = $sdate; $j <= $edate; $j = $j + 86400) {
            //$thisDate = date( 'Y-m-d', $j );
            //echo "$j"."=".$thisDate."<br>";

            $weekday = date("l", $j);
            $currentDate = date('Y-m-d', $j);
            $normalized_weekday = strtolower($weekday);
            if (($normalized_weekday != "saturday") && ($normalized_weekday != "sunday") ) {


                $sql = "SELECT stud_id , att_status, att_time FROM attendance WHERE stud_id = '$dsid' AND cse_id = $selsub AND att_date= '" . date('Ymd', $j) . "'";
                $stmt = $conn->query($sql);
                $result = $stmt->fetch_assoc();
                if (!empty($result)) {
                    //print_r($result);
                    $totlec++;
                    if ($result['att_status'] == 1) {
                        $present++;
                        echo "<td><span class='text-success'>Present</span></td>";
                    } else {
                        echo "<td><span class='text-danger'>Absent</span></td>";
                        $absent++;
                    }
                }else{
                    $totlec++;
                    $absent++;
                    echo "<td><span class='text-danger'>Absent</span></td>";
                }
            } else {
                // if ($normalized_weekday == "saturday") {
                //     echo "<td><span class='text-dark'>Sat</span></td>";
                // } else if ($normalized_weekday == "sunday") {
                //     echo "<td><span class='text-dark'>Sun</span></td>";
                // }
            }
        }
        if ($totlec != 0)
            $perc = round((($present * 100) / $totlec), 2);
        else
            $perc = 0;
        echo "<td><strong>" . $present . "</strong>/" . $totlec . "</td>";
        echo "<td>" . $perc . "&nbsp;%</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table></div>";
} else {
    print '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Sorry!</strong>Please enter correct date range.
              </div>';
}
?>
</body>