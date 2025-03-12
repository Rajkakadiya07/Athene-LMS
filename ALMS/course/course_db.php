<?php
session_start();
require_once "../connection.php";

if (isset($_POST['csename'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    } else {
        echo "Connected<br>";
    }

    $cat = $_POST['csecategory'];
    $csename = $_POST['csename'];
    $cseshortname = $_POST['cseshortname'];
    $csedesc = $_POST['csedesc'] ?? null;
    $csestartdate = $_POST['csestartdate'];
    $cseenddate = $_POST['cseenddate'] ?? null;
    $csesem = $_POST['csesem'];
    $cseimage = null;

    if (isset($_FILES['cseimage'])) {
        $allowed_types = array('jpg', 'jpeg', 'svg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($_FILES['cseimage']['name'], PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_types)) {
            $tmpName = $_FILES['cseimage']['tmp_name'];
            $cseimage = "../images/course/" . $_FILES['cseimage']['name'];
            move_uploaded_file($tmpName, $cseimage);
        }
    } else {
        $cseimage = null;
    }

    $sql = "INSERT INTO `course` (`cse_full_name`, `cse_short_name`, `cse_desc`, `cse_start_date`, " .
        "`cse_end_date`, `cse_semester`, `cse_image`, `cat_id` ) VALUES ('$csename'" .
        ", '$cseshortname', '$csedesc', '$csestartdate', '$cseenddate', '$csesem', '$cseimage', '$cat')";

    if (mysqli_query($conn, $sql)) {
        echo "course added";
    } else {
        die(mysqli_error($conn));
    }
}

if (isset($_POST['ucseshortname'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    }

    $ucsename = $_POST['ucsename'];
    $ucseshortname = $_POST['ucseshortname'];
    $ucsedesc = $_POST['ucsedesc'];
    $ucsestartdate = $_POST['ucsestartdate'];
    $ucseenddate = $_POST['ucseenddate'];
    $ucsesem = $_POST['ucsesem'];

    if (isset($_FILES['ucseimage'])) {
        $allowed_types = array('jpg', 'jpeg', 'svg', 'png', 'gif');
        $file_extension = strtolower(pathinfo($_FILES['ucseimage']['name'], PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed_types)) {
            $tmpName = $_FILES['ucseimage']['tmp_name'];
            $cseimage = "../images/course/" . $_FILES['ucseimage']['name'];
            move_uploaded_file($tmpName, $cseimage);
        }
    } else {
        $cseimage = null;
    }

    if ($cseimage == null) {
        $sql = "UPDATE `course` set cse_full_name = '$ucsename', cse_short_name = '$ucseshortname', cse_desc = '$ucsedesc'," .
            " cse_start_date = '$ucsestartdate', cse_end_date = '$ucseenddate', cse_semester = '$ucsesem'" .
            " where cse_id = {$_SESSION['cse_id']}";
    } else {
        $sql = "UPDATE `course` set cse_full_name = '$ucsename', cse_short_name = '$ucseshortname', cse_desc = '$ucsedesc'," .
            " cse_start_date = '$ucsestartdate', cse_end_date = '$ucseenddate', cse_image = '$cseimage', cse_semester = '$ucsesem'" .
            " where cse_id = {$_SESSION['cse_id']}";
    }


    if (mysqli_query($conn, $sql)) {
        echo "course updated";
        unset($_SESSION['cse_id']);
    } else {
        die(mysqli_error($conn));
    }
}


if (isset($_GET['courseId'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    } else {
        echo "Connected<br>";
    }
    $sql = "select cse_image from course where cse_id = {$_GET['courseId']}";
    $result = mysqli_query($conn, $sql);
    $data = $result->fetch_assoc();
    $image = $data['cse_image'];
    if (empty($image)) {
        echo "No image";
    } else {
        unlink($image);
    }

    $sql = "delete from course where cse_id = {$_GET['courseId']}";
    mysqli_query($conn, $sql);
    unset($_GET);
}


header("location:course_admin.php");
?>