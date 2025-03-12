<?php

require_once "../connection.php";
extract($_POST);
echo "$category > $courseId > $teacherId";

$sql = "INSERT INTO course_teacher values ($courseId, '$teacherId')";
if(mysqli_query($conn, $sql)){
    echo "Data inserted";
}else{
    echo mysqli_error($conn);
}
header("location:course_admin.php");
?>