<?php
session_start();
require_once ("../connection.php");
$sql = "delete from poll where poll_id = {$_GET['pollId']}";
if (mysqli_query($conn, $sql)) {
    echo "Poll Deleted";
} else {
    exit("An error occured");
}
header("location:../course/course_view.php");
?>