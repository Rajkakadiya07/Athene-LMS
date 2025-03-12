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
    $adm_password = null;
    $tchr_password = null;
    $stud_password = null;
    if ($usertype == "admin") {
        $stmt = $conn->prepare("SELECT adm_password FROM admin WHERE adm_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($adm_password);
        $stmt->fetch();
        $stmt->close();

        if (!empty($adm_password) && $adm_password == $password) {
            return true;
        } else {
            return false;
        }
    } else if ($usertype == "teacher") {
        $stmt = $conn->prepare("SELECT tchr_password FROM teacher WHERE tchr_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($tchr_password);
        $stmt->fetch();
        $stmt->close();

        if (!empty($tchr_password) && $tchr_password == $password) {
            return true;
        } else {
            return false;
        }
    } else if ($usertype == "student") {
        $stmt = $conn->prepare("SELECT stud_password FROM student WHERE stud_id = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($stud_password);
        $stmt->fetch();
        $stmt->close();

        if (!empty($stud_password) && $stud_password == $password) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE adm_id = ?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
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
        $stmt = $conn->prepare("SELECT * FROM teacher WHERE tchr_id = ?");
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
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
            $stmt = $conn->prepare("SELECT * FROM student WHERE stud_id = ?");
            $stmt->bind_param("s", $_POST['username']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
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