<?php
session_start();

require_once "user_verification_class.php";
$verification = new UserVerification();
if (!empty($_SESSION['userid']) && !empty($_SESSION['usertype']) && $verification->checkUserId($_SESSION['userid'], $_SESSION['usertype'])) {
    // Do nothing
    // echo "<h1>{$_SESSION['userid']} ---- {$_SESSION['username']} ---- {$verification->checkUserId($_SESSION['userid'], $_SESSION['usertype'])}</h1>";
    // echo "You're logged in";
} else {
    // header('Location: ../authentication/user_auth.php');
    // exit;
}
?>