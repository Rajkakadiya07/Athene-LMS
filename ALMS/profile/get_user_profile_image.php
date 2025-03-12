<?php
session_start();


if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit();
}

$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

$validUserTypes = ["Admin", "Student", "Teacher"];

if (!in_array($usertype, $validUserTypes)) {
    echo json_encode(["error" => "Invalid user type"]);
    exit();
}

require_once "../connection.php";

$table = strtolower($usertype);


switch ($usertype) {
    case "Admin":
        $id_column = "adm_id";
        $image_column = "adm_profile_image";
        break;
    case "Teacher":
        $id_column = "tchr_id";
        $image_column = "tchr_profile_image";
        break;
    case "Student":
        $id_column = "stud_id";
        $image_column = "stud_profile_image";
        break;
    default:
        echo json_encode(["error" => "Invalid user type"]);
        exit();
}

$query = "SELECT $image_column as image_path FROM $table WHERE $id_column = '$userid'";
$result = mysqli_query($conn, $query);



if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        unset($row[$usertype . "_password"]);
        $row['usertype'] = $usertype;
        echo json_encode([$row]);
    } else {
        echo "SQL Query: $query<br>";
        echo json_encode(["error" => "User not found"]);
    }
} else {
    echo json_encode(["error" => "Database error: " . mysqli_error($conn)]);
}


mysqli_close($conn);
?>