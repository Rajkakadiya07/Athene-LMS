<?php
session_start();
require_once "../connection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    $currentPassword = $_POST["password"];
    $newPassword = $_POST["newpassword"];
    $confirmPassword = $_POST["renewpassword"];
    $usertype = $_SESSION['usertype'];
    $userid = $_SESSION['userid'];

    $updateProfileQuery = "";
    $passwordColumn = "";
    $idColumn = "";

    switch ($usertype) {
        case "Admin":
            $idColumn = "adm_id";
            $passwordColumn = "adm_password";
            break;
        case "Student":
            $idColumn = "stud_id";
            $passwordColumn = "stud_password";
            break;
        case "Teacher":
            $idColumn = "tchr_id";
            $passwordColumn = "tchr_password";
            break;
        default:
            echo "Invalid user type.";
            exit();
    }

    if (!empty($idColumn) && !empty($passwordColumn)) {
        $checkQuery = "SELECT $passwordColumn FROM $usertype WHERE $idColumn = '$userid'";
        $result = mysqli_query($conn, $checkQuery);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $storedPassword = $row[$passwordColumn];

                if ($currentPassword === $storedPassword) {
                    if ($newPassword === $confirmPassword) {
                        $updateProfileQuery = "UPDATE $usertype SET $passwordColumn = '$newPassword' WHERE $idColumn = '$userid'";
                        
                        if (mysqli_query($conn, $updateProfileQuery)) {
                            echo "Password changed successfully.";
                            exit();
                        } else {
                            echo "Error updating password: " . mysqli_error($conn);
                        }
                    } else {
                        echo "New passwords do not match.";
                    }
                } else {
                    echo "Incorrect current password.";
                }
            } else {
                echo "User not found.";
            }
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid user type or password column.";
    }
}
?>
