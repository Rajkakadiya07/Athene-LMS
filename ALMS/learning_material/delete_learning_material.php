<?php
session_start();
require_once "../connection.php";

if(isset($_GET['materialId'])){
    $fileQuery = "SELECT lm_file from learning_material where lm_id = {$_GET['materialId']} and lm_file is not null";
    if($result = mysqli_query($conn, $fileQuery)){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(file_exists($row['lm_file'])){
                    unlink($row['lm_file']);
                    echo "Path: {$row['lm_file']} => File: ".basename($row['lm_file']) . " DELETED";
                }
            }
        }
    }

    $sql = "delete from learning_material where lm_id = {$_GET['materialId']}";
    if(mysqli_query($conn, $sql)){
        echo "Learning material deleted";
    }
}else{
    exit("ID not found");
}
header("location:../course/course_view.php?cseId={$_SESSION['course']['cse_id']}");
?>