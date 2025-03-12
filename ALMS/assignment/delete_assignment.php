<?php
session_start();
require_once "../connection.php";

if(isset($_GET['agnId'])){
    $fileQuery = "SELECT agn_submission_file from assignment_submission where agn_id = {$_GET['agnId']} and agn_submission_file is not null";
    if($result = mysqli_query($conn, $fileQuery)){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(file_exists($row['agn_submission_file'])){
                    unlink($row['agn_submission_file']);
                    echo "Path: {$row['agn_submission_file']} => File: ".basename($row['agn_submission_file']) . " DELETED";
                }
            }
        }
    }

    $sql = "delete from assignment where agn_id = {$_GET['agnId']}";
    if(mysqli_query($conn, $sql)){
        echo "Assignment deleted";
    }
}else{
    exit("ID not found");
}
header("location:../course/course_view.php?cseId={$_SESSION['course']['cse_id']}");
?>