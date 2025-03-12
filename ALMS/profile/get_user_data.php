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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST["user_id"];
    $new_value = $_POST["new_value"];

    $table = strtolower($usertype); 

    switch ($usertype) {
        case "Admin":
            $admin_data_column = $_POST["admin_data_column"];
            $updateColumn = mysqli_real_escape_string($conn, $admin_data_column);
            $result = mysqli_query($conn, "UPDATE $table SET $updateColumn = '$new_value' WHERE adm_id = '$user_id'");
            break;
        case "Teacher":
            $teacher_data_column = $_POST["teacher_data_column"];
            $updateColumn = mysqli_real_escape_string($conn, $teacher_data_column);
            $result = mysqli_query($conn, "UPDATE $table SET $updateColumn = '$new_value' WHERE tchr_id = '$user_id'");
            break;
        case "Student":
            $student_data_column = $_POST["student_data_column"];
            $updateColumn = mysqli_real_escape_string($conn, $student_data_column);
            $result = mysqli_query($conn, "UPDATE $table SET $updateColumn = '$new_value' WHERE stud_id = '$user_id'");
            break;
        default:
            echo json_encode(["error" => "Invalid user type"]);
            exit();
    }

    if ($result) {
        echo json_encode(["message" => "{$usertype} data updated successfully"]);
    } else {
        echo json_encode(["error" => "Update error: " . mysqli_error($conn)]);
    }
} else {
    $table = strtolower($usertype); 

  
    switch ($usertype) {
        case "Admin":
            $id_column = "adm_id";
            $image_column = "adm_img";
            break;
        case "Teacher":
            $id_column = "tchr_id";
            $image_column = "tchr_img";
            break;
        case "Student":
            $id_column = "stud_id";
            $image_column = "stud_img";
            break;
        default:
            echo json_encode(["error" => "Invalid user type"]);
            exit();
    }

    $query = "SELECT *, $image_column as image_path FROM $table WHERE $id_column = '$userid'";
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
}

mysqli_close($conn);
?>
