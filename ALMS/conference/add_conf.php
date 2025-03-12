<?php
session_start();
require_once "../connection.php";

date_default_timezone_set('Asia/Kolkata');

function generateConfCode($length = 16)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $confCode = '';

    for ($i = 0; $i < $length; $i++) {
        $confCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $confCode;
}


if (isset($_POST['btnSubmit'])) {
    // Assuming you have sanitized the input values to prevent SQL injection
    $confName = mysqli_real_escape_string($conn, $_POST['cName']);
    $confDesc = mysqli_real_escape_string($conn, $_POST['cDesc']);
    $confStartDateTime = trim($_POST["sDateTime"]);
    $confEndDateTime = trim($_POST["eDateTime"]);
    $confCode = generateConfCode();

    $tchrid = $_SESSION['userid'];
    $cseid = $_SESSION['course']['cse_id'];

    $sql = "INSERT INTO conference (tchr_id, cse_id, conf_name, conf_desc, conf_code, conf_start_datetime, conf_end_datetime) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";


    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sisssss", $tchrid, $cseid, $confName, $confDesc, $confCode, $confStartDateTime, $confEndDateTime);
        if ($stmt->execute()) {
            echo "Conference created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close(); 
    } else {
        echo "Error: " . mysqli_error($conn); // Add this line to display the error
    }

    // Finally, close the connection after all queries are executed
    mysqli_close($conn);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
else {
    echo "<h1> Something Went Wrong </h1>";
}