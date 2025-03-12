<?php
require('../connection.php');

// https://netcorecloud.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/ guide for phpmailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$response = array();

if (isset($_POST['btnAcceptStudent'])) {
    $sql = "INSERT INTO student SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, 1, usr_password, false FROM pending_requests WHERE usr_id = '{$_POST['btnAcceptStudent']}'";
    $result = mysqli_query($conn, $sql);
    if ($result) { //if sql query will find any records it will return object otherwise it will return false
        $response['id'] = $_POST['btnAcceptStudent'];
        regConfirmation($response['id'], "student", $conn);
        $response['errorcode'] = 0;
        $response['message'] = "Student {$_POST['btnAcceptStudent']} registered successfully";
        $sql = "DELETE FROM pending_requests WHERE usr_id = {$_POST['btnAcceptStudent']}";
        mysqli_query($conn, $sql);
    } else {
        $response['id'] = $_POST['btnAcceptStudent'];
        $response['errorcode'] = $conn->errno;
        $response['message'] = "Error: {$conn->error}";
    }
    unset($_POST['btnAcceptStudent']);
}

if (isset($_POST['btnRejectStudent'])) {
    $sql = "DELETE FROM pending_requests where usr_id ='{$_POST['btnRejectStudent']}'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response['id'] = $_POST['btnRejectStudent'];
        $response['message'] = "Student {$_POST['btnRejectStudent']} rejected.";
    } else {
        $response['id'] = $_POST['btnAcceptStudent'];
        $response['errorcode'] = $conn->errno;
        $response['message'] = "Error: {$conn->error}";
    }
    unset($_POST['btnRejectStudent']);
}


if (isset($_POST['btnAcceptTeacher'])) {
    $sql = "INSERT INTO teacher SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, usr_password, false FROM pending_requests WHERE usr_id = {$_POST['btnAcceptTeacher']}'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response['id'] = $_POST['btnAcceptTeacher'];
        regConfirmation($response['id'], "teacher", $conn);
        $response['errorcode'] = 0;
        $response['message'] = "Teacher {$_POST['btnAcceptTeacher']} registered successfully";
        $sql = "DELETE FROM pending_requests WHERE usr_id ={$_POST['btnAcceptTeacher']}";
        mysqli_query($conn, $sql);
    } else {
        $response['id'] = $_POST['btnAcceptTeacher'];
        $response['errorcode'] = $conn->errno;
        $response['message'] = "Error: {$conn->error}";
    }
    unset($_POST['btnAcceptTeacher']);
}


if (isset($_POST['btnRejectTeacher'])) {
    $sql = "DELETE FROM pending_requests where usr_id ='{$_POST['btnRejectTeacher']}'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $response['id'] = $_POST['btnAcceptStudent'];
        $response['message'] = "Teacher {$_POST['btnRejectTeacher']} rejected.";
    } else {
        $response['id'] = $_POST['btnRejectTeacher'];
        $response['errorcode'] = $conn->errno;
        $response['message'] = "Error: {$conn->error}<br>";
    }
    unset($_POST['btnRejectTeacher']);
}

function regConfirmation($userid, $usertype, $conn)
{
    if ($usertype == 'student') {
        $sql = "select stud_email from student where stud_id = '$userid'";
        $result = mysqli_query($conn, $sql);
        $flag['noofrows'] = $result->num_rows;

        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $to = $row['stud_email'];
            $flag['email'] = $to;
        }
    } else if ($usertype == 'teacher') {
        $sql = "select tchr_email from teacher where tchr_id = '$userid'";
        $result = mysqli_query($conn, $sql);
        $flag['noofrows'] = $result->num_rows;
        $count = $result->num_rows;
        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);
            $to = $row['tchr_email'];
            $flag['email'] = $to;
        }
    }
    
    
    $subject = "Athene LMS - Registration";
    $message = "Your account has been registered successfully.<br>Your user id is $userid";
    
    
    try{
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        
        $mail->SMTPDebug  = 0;  // It will prevent logs to be printed. User value 1 to get logs for debugging 
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->Username   = "rishabhmandavlia2001@gmail.com";
        $mail->Password   = "vkjcejggdbrlyvzp";
        
        
        $mail->IsHTML(true);
        $mail->addAddress($to);
        $mail->SetFrom("athenelmsadmin@test.org", "Athene LMS");
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        if (!$mail->Send()) {
            $flag['mail'] = "Mail sent";
        } else {
            $flag['mail'] = "Error occured";
        }
    }
    catch(Exception $e){
        $e->getMessage();
    }    
}

echo json_encode($response);
