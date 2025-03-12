<?php
session_start();
unset($_SESSION);
session_destroy();
$url = "./login/login.php";
header("Location:$url");
?>