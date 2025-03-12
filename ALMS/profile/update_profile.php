<?php
session_start();

$userid = $_SESSION['userid'];
if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit;
}
require_once "../connection.php";

$fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

if ($_SESSION['usertype'] == "Admin") {
    $updateProfileQuery = "UPDATE admin SET adm_name = ?, adm_contact_no = ?, adm_email = ? WHERE adm_id = ?";
} else if ($_SESSION['usertype'] == "Student") {
    $updateProfileQuery = "UPDATE student SET stud_name = ?, stud_contact_no = ?, stud_email = ? WHERE stud_id = ?";
} else if ($_SESSION['usertype'] == "Teacher") {
    $updateProfileQuery = "UPDATE teacher SET tchr_name = ?, tchr_contact_no = ?, tchr_email = ? WHERE tchr_id = ?";
}

// echo $updateProfileQuery . "<br>$fullName, $contact, $email, {";

$stmt = mysqli_prepare($conn, $updateProfileQuery);
mysqli_stmt_bind_param($stmt, "ssss", $fullName, $contact, $email, $userid);

if (mysqli_stmt_execute($stmt)) {
    echo "success";
} else {
    echo "Error updating profile: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>