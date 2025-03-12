<?php
session_start();
require_once "../connection.php";


extract($_POST);
$sql = null;
if ($_SESSION['usertype'] == "Student") {
    $sql = "insert into student_poll_answers (stud_id, poll_answer_id) values ('{$_SESSION['userid']}', $option)";
    echo "$sql<br>";

    if(!empty($sql) && mysqli_query($conn, $sql)){
        echo "Poll answer submitted";
    }else{
        echo mysqli_error($conn);
    }
} 

header("location:{$_SERVER['HTTP_REFERER']}");

?>