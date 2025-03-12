<?php 

date_default_timezone_set("Asia/Kolkata");
require_once 'common-functions.php';

// inserting end time
if (isset($_POST["endedMeeting"]) && isset($_POST["conferenceId"])) {

    $conference_id = trim($_POST["conferenceId"]);
    $student_id = trim($_POST["studentId"]);
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE conference_participants SET leave_time = ? WHERE conference_id = ? AND student_id = ?;";

    doDBConnection();
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("sii",$currentDateTime,$conference_id,$student_id);
        $stmt->execute();
        $stmt->close();
    }

    closeDBConnection();
}