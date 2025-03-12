<?php
session_start();

if (!empty($_FILES['attachment']['name'])) {
    $dir = "../assignment/uploaded_files/" . $_SESSION['course']['cse_full_name'];
    if (!is_dir($dir)) {
        mkdir($dir);
    }
    $file = $_FILES['attachment']['tmp_name'];
    $filepath = $dir . "/" . $_FILES['attachment']['name'];
    move_uploaded_file($file, $filepath);

    require_once '../connection.php';
    $sql = "update assignment set agn_file = '{$filepath}' where agn_id = {$_SESSION['assignment']['agn_id']}";

    if (mysqli_query($conn, $sql)) {
        echo "Updated file";
    } else {
        echo mysqli_error($conn);
    }
}
header("location:{$_SERVER['HTTP_REFERER']}");
?>