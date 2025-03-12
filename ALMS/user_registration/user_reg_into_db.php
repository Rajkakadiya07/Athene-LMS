<?php
session_start();
require('../connection.php');

$response = array();
if (isset($_POST['userId']) && isset($_POST['buttonId'])) {

    $userId = $_POST['userId'];
    $btnId = $_POST['buttonId'];

    if (substr($btnId, 0, 3) == 'bas') {
        $sql = "INSERT INTO student SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, 1, usr_password, false FROM pending_requests WHERE usr_id = '{$userId}'";
        $result = mysqli_query($conn, $sql);
        if ($result) { //if sql query will find any records it will return object otherwise it will return false
            regConfirmation($userId, "student", $conn, $btnId);
            $response['errorcode'] = 0;
            $response['message'] = "Student {$userId} registered successfully";
            $sql = "DELETE FROM pending_requests WHERE usr_id = '{$userId}'";
            mysqli_query($conn, $sql);
        } else {
            $response['errorcode'] = $conn->errno;
            $response['message'] = "Error: {$conn->error}";
        }
        unset($_POST['userId']);
        unset($_POST['buttonId']);
    }

    if (substr($btnId, 0, 3) == 'brs') {
        regConfirmation($userId, "student", $conn, $btnId);
        $sql = "DELETE FROM pending_requests where usr_id ='{$userId}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response['message'] = "Student {$userId} rejected.";
        } else {
            $response['errorcode'] = $conn->errno;
            $response['message'] = "Error: {$conn->error}";
        }
        unset($_POST['userId']);
        unset($_POST['buttonId']);
    }


    if (substr($btnId, 0, 3) == 'bat') {
        $sql = "INSERT INTO teacher SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, usr_password, false FROM pending_requests WHERE usr_id = '{$userId}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            regConfirmation($userId, "teacher", $conn, $btnId);
            $response['errorcode'] = 0;
            $response['message'] = "Teacher {$userId} registered successfully";
            $sql = "DELETE FROM pending_requests WHERE usr_id = '{$userId}'";
            mysqli_query($conn, $sql);
        } else {
            $response['errorcode'] = $conn->errno;
            $response['message'] = "Error: {$conn->error}";
        }
        unset($_POST['userId']);
        unset($_POST['buttonId']);
    }


    if (substr($btnId, 0, 3) == 'brt') {
        regConfirmation($userId, "teacher", $conn, $btnId);
        $sql = "DELETE FROM pending_requests where usr_id ='{$userId}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response['message'] = "Teacher {$userId} rejected.";
        } else {
            $response['errorcode'] = $conn->errno;
            $response['message'] = "Error: {$conn->error}<br>";
        }
        unset($_POST['userId']);
        unset($_POST['buttonId']);
    }
}

$response['btnid'] = $btnId;
$response['id'] = $userId;


function regConfirmation($userid, $usertype, $conn, $btnId)
{

    global $response;

    if (substr($btnId, 0, 2) == "ba") {
        if ($usertype == 'student') {
            $sql = "select stud_email from student where stud_id = '$userid'";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows == 1) {
                $row = mysqli_fetch_assoc($result);
                $response['email'] = $row['stud_email']; 
            }
        } else if ($usertype == 'teacher') {
            $sql = "select tchr_email from teacher where tchr_id = '$userid'";
            $result = mysqli_query($conn, $sql);
            $count = $result->num_rows;
            if ($count == 1) {
                $row = mysqli_fetch_assoc($result);
                $response['email'] = $row['tchr_email'];
            }
        }
    } else if (substr($btnId, 0, 2) == "br") {
        $sql = "select usr_email from pending_requests where usr_id = '$userid'";
        $result = mysqli_query($conn, $sql);
            $count = $result->num_rows;
            if ($count == 1) {
                $row = mysqli_fetch_assoc($result);
                $response['email'] = $row['usr_email'];
            }

    }

    $response['subject'] = "Athen LMS - Registration";
    if (substr($btnId, 0, 2) == "ba") {
        $response['emailMessage'] = "Your account has been registered successfully. Your user id is $userid";
    } else if (substr($btnId, 0, 2) == "br") {
        $response['emailMessage'] = "Your registration request is reject for some reason. Please check if you have entered any details that might be wrong or belong to someone else. ";
    }
}

echo json_encode($response);
