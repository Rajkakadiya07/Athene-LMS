<?php
session_start();
require_once "../connection.php";


$cseId = $_SESSION['course']['cse_id'];


extract($_POST);

$dt1 = new DateTime($startDate);
$sd = $dt1->format('Y-m-d H:i:s');

$poll_id = null;

$sql = "insert into poll (poll_name, poll_text, poll_date_time, cse_id) values ('$poll_name','$poll_question', '$sd', $cseId)";
if (mysqli_query($conn, $sql)) {
    echo "Poll added<br>";
    $poll_id = mysqli_insert_id($conn);
    if (empty($poll_id)) {
        exit("An error occured");
    }
} else {

    exit("An error occured");
}

foreach ($poll_options as $option) {
    $query_for_option = "insert into poll_answers (poll_id, poll_answer) values ($poll_id, '$option')";
    if (mysqli_query($conn, $query_for_option)) {
        echo "Option : $option Added <br>";
    } else {
        exit("An error occured");
    }
}

header("location:{$_SERVER['HTTP_REFERER']}");


?>