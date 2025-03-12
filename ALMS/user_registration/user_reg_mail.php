<?php

// https://netcorecloud.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/ guide for phpmailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if(isset($_POST['userEmail']) && $_POST['subject'] && $_POST['emailMessage']){

    $to = $_POST['userEmail'];
    $subject = $_POST['subject'];
    $message = $_POST['emailMessage'];

    try {

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
    } catch (Exception $e) {
        $e->getMessage();
    }
    
}
