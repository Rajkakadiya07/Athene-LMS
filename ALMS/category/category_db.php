<?php
session_start();
require_once "../connection.php";

if (isset($_POST['shortname'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    } else {
        echo "Connected<br>";
    }

    $shortName = $_POST['shortname'];
    $fullName = $_POST['fullname'];

    $sql = "INSERT INTO `category` (`cat_short_name`, `cat_full_name`) VALUES ('$shortName', '$fullName')";

    if (mysqli_query($conn, $sql)) {
        echo "category added";
    } else {
        die(mysqli_error($conn));
    }
}

if (isset($_POST['ushortname'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    }
    echo "<h1>FormSubmitted</h1>";

    $shortName = $_POST['ushortname'];
    $fullName = $_POST['ufullname'];

    $sql = "UPDATE `category` set cat_short_name = '$shortName', cat_full_name = '$fullName' where cat_id = {$_SESSION['cat_id']}";

    if (mysqli_query($conn, $sql)) {
        echo "category updated";
        unset($_SESSION['cat_id']);
    } else {
        die(mysqli_error($conn));
    }
}


if (isset($_GET['deleteCategory'])) {
    if (!$conn) {
        echo mysqli_connect_error();
    } else {
        echo "Connected<br>";
    }
    $sql = "delete from category where cat_id = {$_GET['deleteCategory']}";
    mysqli_query($conn, $sql);
    unset($_GET);
}


header("location:category_admin.php");
?>