<?php
require_once "../connection.php";
extract($_POST);

$sql = "select distinct ques_sub_topic from question where ques_topic = '" . $topic . "'";
if ($result = mysqli_query($conn, $sql)) {
    if ($result->num_rows > 0) {
        echo "<option value=''>Select Sub Topic</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ques_sub_topic']}'>{$row['ques_sub_topic']}</option>";
        }
    } else {
        $sql = "select distinct ques_sub_topic from question";
        if ($result = mysqli_query($conn, $sql)) {
            if ($result->num_rows > 0) {
                echo "<option value=''>Select Sub Topic</option>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['ques_sub_topic']}'>{$row['ques_sub_topic']}</option>";
                }
            }
        }
    }
}
?>