<?php
require('../connection.php');

$fullname = trim($_POST['fullname']);
$email = trim($_POST['email']);
$contactno = trim($_POST['contactno']);
$gender = trim($_POST['gender']);
$usertype = $_POST['usertype'];
$userid = trim($_POST['userid']);
if (isset($_POST['category'])) {
    $category = $_POST['category'];
}
$password1 = trim($_POST['password']);
$confpassword = trim($_POST['confpassword']);

if (isset($_POST['category'])) {
    $flag = array('fullname' => true, 'email' => true, 'contactno' => true, 'gender' => true, 'usertype' => true, 'userid' => true, 'category' => true, 'password' => true, 'confpassword' => true);
} else {
    $flag = array('fullname' => true, 'email' => true, 'contactno' => true, 'gender' => true, 'userid' => true, 'usertype' => true, 'password' => true, 'confpassword' => true);
}


//It will validate form data on server side

// Validation started

if ($fullname == "" || !preg_match("/^[A-Z][a-zA-Z ]*$/", $fullname)) {
    $flag['fullname'] = false;
}

if ($email == "" || !preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
    $flag['email'] = false;
}

if ($contactno == "" || !preg_match("/^\d{10}$/", $contactno)) {
    $flag['contactno'] = false;
}

if ($gender != "m" && $gender != "f") {
    $flag['gender'] = false;
}

if ($usertype != "student" && $usertype != "teacher") {
    $flag['usertype'] = false;
}

if ($userid == "student") {
    if ($userid == "" || !preg_match("/^\d{10,15}$/", $userid)) {
        $flag['userid'] = false;
    }
}

if ($userid == "teacher") {
    if ($userid == "" || !preg_match("/[~!%^&*()+=*?\-\"',.;:|]/", $userid)) {
        $flag['userid'] = false;
    }
}

if (isset($_POST['category'])) {
    if ($category == "") {
        $flag['category'] = false;
    }
}

if ($password1 == "" || !preg_match("/^(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*_]{8,16}$/", $password1) ) {
    $flag['password'] = false;
}

if ($password1 != $confpassword) {
    $flag['confpassword'] = false;
}

// Validation ended

//Insert into database
if (isset($category)) {
    if ($flag['fullname'] == true && $flag['email'] == true && $flag['contactno'] == true && $flag['gender'] == true && $flag['userid'] == true && $flag['usertype'] == true && $flag['category'] == true && $flag['password'] == true && $flag['confpassword'] == true) {
        $sql = "insert into pending_requests (usr_id, usr_name, usr_contact_no, usr_gender, usr_email, usr_password, usr_type, usr_stud_category) values ('$userid', '$fullname', '$contactno', '$gender', '$email', '$password1', '$usertype', '$category')";
    }
} else {
    if ($flag['fullname'] == true && $flag['email'] == true && $flag['contactno'] == true && $flag['gender'] == true && $flag['userid'] == true && $flag['usertype'] == true && $flag['password'] == true && $flag['confpassword'] == true) {
        $sql = "insert into pending_requests (usr_id, usr_name, usr_contact_no, usr_gender, usr_email, usr_password, usr_type) values ('$userid', '$fullname', '$contactno', '$gender', '$email', '$password1', '$usertype')";
    }
}

if (isset($sql)) {
    if ($conn->query($sql) === TRUE) {
        $flag['success'] = true;
    } else {
        $flag['success'] = false;
        $flag['errorcode'] = $conn->errno;
        $flag['errormessage'] = $conn->error;
    }
}


$conn->close();

echo json_encode($flag);
