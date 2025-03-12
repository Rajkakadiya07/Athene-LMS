<?php
session_start();
require_once "../connection.php";

extract($_POST);
// echo "$name, $desc, $udate";
if (isset($name)) {
    $udate = date("Y-m-d H:i:s", strtotime($udate));

    $sql = "update learning_material set lm_name = '$name', lm_desc = '$desc', lm_upload_date_time = '$udate' where lm_id = {$_SESSION['LM']['lm_id']}";

    if (mysqli_query($conn, $sql)) {
        echo "Learning material updated";
    } else {
        echo mysqli_error($conn);
    }
}


// header("location:{$_SERVER['HTTP_REFERER']}");
?>