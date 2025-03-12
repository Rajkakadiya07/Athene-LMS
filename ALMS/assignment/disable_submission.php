<?php
session_start();
require_once "../connection.php";

if(isset($_GET['disable']) && $_GET['disable'] == 1){
    $sql = "update assignment set agn_disable_submission = 1 where agn_id = {$_SESSION['assignment']['agn_id']}";
    if(mysqli_query($conn, $sql)){
        echo "Disabled submission for {$_SESSION['assignment']['agn_name']}";
    }else{
        echo mysqli_error($conn);
    }
}
if(isset($_GET['enable']) && $_GET['enable'] == 1){
    $sql = "update assignment set agn_disable_submission = 0 where agn_id = {$_SESSION['assignment']['agn_id']}";
    if(mysqli_query($conn, $sql)){
        echo "Enabled submission for {$_SESSION['assignment']['agn_name']}";
    }else{
        echo mysqli_error($conn);
    }
}
header("location:{$_SERVER['HTTP_REFERER']}")
?>