<?php
session_start();
require_once "../connection.php";
extract($_POST);
$cseId = $_SESSION['course']['cse_id'];


date_default_timezone_set('Asia/Kolkata');

// echo "$name, $description, $startDate, $endDate, $totMarks<br>";

$dt1 = new DateTime($startDate);
$dt2 = new DateTime($endDate);

$sd= $dt1->format('Y-m-d H:i:s');
$ed= $dt2->format('Y-m-d H:i:s');

// echo "$sd, $ed<br>";

$sql = "UPDATE assignment SET agn_name = '$name', agn_desc = '$description', agn_total_marks = $totMarks, agn_start_date =  '$sd', agn_end_date = '$ed' WHERE agn_id = '{$_SESSION['assignment']['agn_id']}'";


if(mysqli_query($conn, $sql)){
    echo "Updated";
}else{
    echo mysqli_error($conn);
}

header("location:../assignment/view_assignment.php?agnId={$_SESSION['assignment']['agn_id']}");
?>