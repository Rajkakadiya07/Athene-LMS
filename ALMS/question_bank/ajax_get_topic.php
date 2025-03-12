<?php
require_once "../connection.php";
extract($_POST);

$sql = "select distinct ques_topic from question where ques_category = '" . $category . "'";
$response = [];
if ($result = mysqli_query($conn, $sql)) {
    if ($result->num_rows > 0) {
        echo "<option value=''>Select Topic</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ques_topic']}'>" . $row['ques_topic'] . "</option>";
        }
    } else {
        $sql = "select distinct ques_topic from question";
        if ($result = mysqli_query($conn, $sql)) {
            if ($result->num_rows > 0) {
                echo "<option value=''>Select Topic</option>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['ques_topic']}'>" . $row['ques_topic'] . "</option>";
                }
            }
        }
    }
}

?>