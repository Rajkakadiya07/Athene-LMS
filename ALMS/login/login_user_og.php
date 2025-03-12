<?php
session_start();

require("../connection.php");

$response['code'] = 0;
$response['pcode'] = 0;
$response['canlogin'] = false;
$response['message'] = "Success";

function checkPassword($username, $password, $usertype)
{
    global $conn;
    if ($usertype == "admin") {
        $sql = "select adm_password from admin where adm_id = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if ($row['adm_password'] == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else if ($usertype == "teacher") {
        $response['teacherpass'] = "teacher password blockl";
        $sql = "select tchr_password from teacher where tchr_id = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if ($row['tchr_password'] == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else if ($usertype == "student") {
        $sql = "select stud_password from student where stud_id = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            if ($row['stud_password'] == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $sql = "select * from admin where adm_id = '{$_POST['username']}'";
    $result = mysqli_query($conn, $sql);
    if ($result != false) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
    } else {
        $count == 0;
    }

    if ($count == 1) {
        $response['usertype'] = "admin";
        if (checkPassword($_POST['username'], $_POST['password'], "admin")) {
            $response['canlogin'] = true;
            $_SESSION['userid'] = $row['adm_id'];
            $_SESSION['username'] = $row['adm_name'];
            $_SESSION['usertype'] = "Admin";
        } else {
            $response['pcode'] = 101;
            $response['message'] = "Sorry, your password is incorrect.";
        }
    } else {
        $sql = "select * from teacher where tchr_id = '{$_POST['username']}'";
        $result = mysqli_query($conn, $sql);
        if ($result != false) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
        } else {
            $count == 0;
        }

        if ($count == 1) {
            $response['usertype'] = "teacher";
            if (checkPassword($_POST['username'], $_POST['password'], "teacher")) {
                $response['canlogin'] = true;
                $_SESSION['userid'] = $row['tchr_id'];
                $_SESSION['username'] = $row['tchr_name'];
                $_SESSION['usertype'] = "Teacher";
            } else {
                $response['pcode'] = 101;
                $response['message'] = "Sorry, your password is incorrect.";
            }
        } else {
            $sql = "select * from student where stud_id = '{$_POST['username']}'";
            $result = mysqli_query($conn, $sql);
            if ($result != false) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);
            } else {
                $count == 0;
            }

            if ($count == 1) {
                $response['usertype'] = "student";
                if (checkPassword($_POST['username'], $_POST['password'], "student")) {
                    $response['canlogin'] = true;
                    $_SESSION['userid'] = $row['stud_id'];
                    $_SESSION['username'] = $row['stud_name'];
                    $_SESSION['usertype'] = "Student";
                } else {
                    $response['pcode'] = 101;
                    $response['message'] = "Sorry, your password is incorrect.";
                }
            } else {
                $response['code'] = 100;
                $response['message'] = "User id not found";
            }
        }
    }
}

echo json_encode($response);