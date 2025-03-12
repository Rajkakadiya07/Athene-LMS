<?php 

date_default_timezone_set("Asia/Kolkata");
require_once 'common-functions.php';
if (isset($_POST["startedMeeting"]) && isset($_POST["conferenceId"])) {

    $conference_id = trim($_POST["conferenceId"]);
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "REPLACE INTO conference_data(conference_id,start_date) VALUES(?,?)";

    doDBConnection();
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("is",$conference_id,$currentDateTime);
        $stmt->execute();
        $stmt->close();
    }

    closeDBConnection();
}



// inserting end time
if (isset($_POST["endedMeeting"]) && isset($_POST["conferenceId"])) {

    $conference_id = trim($_POST["conferenceId"]);
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE conference_data SET end_date = ? WHERE conference_id = ?;";

    doDBConnection();
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("si",$currentDateTime,$conference_id);
        $stmt->execute();
        $stmt->close();
    }

    $sql = "UPDATE conferences SET status = 1 WHERE conference_id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i",$conference_id);
        $stmt->execute();
        $stmt->close();
    }

    closeDBConnection();
}