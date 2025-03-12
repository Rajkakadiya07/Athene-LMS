<?php
session_start();
require_once "../connection.php";

$userName = $_SESSION['username'];
$userid = $_SESSION['userid'];
$usertype = $_SESSION['usertype'];

$targetDir = "../profile/user_images";


if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

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


$query = "SELECT *, $image_column as image_path FROM $table WHERE $id_column = '$userid'";
// echo $query;
$result = mysqli_query($conn, $query);
$file_path = $result->fetch_assoc()['image_path'];

// echo "<br><br>Exists". file_exists($targetDir . "/" . $file_name);
echo $file_path;

if (file_exists($file_path) && !is_dir($file_path)) {
    // Check if the file exists
    // echo file_exists($file_path);   
    if (unlink($file_path)) {
        $sql = "UPDATE $table SET $image_column = null WHERE $id_column = '$userid'";
        mysqli_query($conn, $sql);
        updateImage($userid, $targetDir, $_FILES, $conn);
    } else {
        // If there was an issue deleting the file
    }
} else {
    updateImage($userid, $targetDir, $_FILES, $conn);
}

function updateImage($userid, $targetDir, $FILES, $conn)
{
    $profileImage = $FILES['profileImage']['name'];

    // If the file does not exist
    if (!empty($profileImage)) {
        $profileImageName = $userid . '_' . time() . '_' . basename($profileImage);

        $targetFilePath = $targetDir . "/" . $profileImageName;

        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        $maxWidth = 300;
        $quality = 75;

        list($width, $height) = getimagesize($FILES['profileImage']['tmp_name']);
        $aspectRatio = $width / $height;

        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = $newWidth / $aspectRatio;
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }

        $compressedImage = imagecreatetruecolor($newWidth, $newHeight);
        $sourceImage = imagecreatefrompng($FILES['profileImage']['tmp_name']);

        imagecopyresampled($compressedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);


        imagejpeg($compressedImage, $targetFilePath, $quality);

        imagedestroy($compressedImage);
        imagedestroy($sourceImage);

        $relativePath = $targetDir . "/" . basename($targetFilePath);

        if ($_SESSION['usertype'] == "Admin") {
            $updateImageQuery = "UPDATE admin SET adm_profile_image = ? WHERE adm_id = ?";
        } else if ($_SESSION['usertype'] == "Student") {
            $updateImageQuery = "UPDATE student SET stud_profile_image = ? WHERE stud_id = ?";
        } else if ($_SESSION['usertype'] == "Teacher") {
            $updateImageQuery = "UPDATE teacher SET tchr_profile_image = ? WHERE tchr_id = ?";
        }

        $stmt = mysqli_prepare($conn, $updateImageQuery);
        mysqli_stmt_bind_param($stmt, "ss", $relativePath, $userid);

        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "Error updating profile image: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

?>