<?php
session_start();
if(isset($_GET['path'])){
    if(file_exists($_GET['path'])){
        unlink($_GET['path']);
        echo "Path: {$_GET['path']} => File: ".basename($_GET['path']) . " DELETED<br>";

        require_once '../connection.php';
        $sql = "UPDATE assignment_submission set agn_submission_file = null, agn_submission_date_time = null, agn_submission_status = 0 where agn_id = {$_SESSION['assignment']['agn_id']} and stud_id = {$_SESSION['userid']}";
        if(mysqli_query($conn, $sql)){
            echo "Deleted";
        }else{

        }
    }else{
        echo "File does not exists";
    }

}
header("location:{$_SERVER['HTTP_REFERER']}");

?>