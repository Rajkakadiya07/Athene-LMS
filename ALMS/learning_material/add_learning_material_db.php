<?php
session_start();
require_once "../connection.php";

extract($_POST);
// echo "$name, $desc, $udate";
$udate = date("Y-m-d H:i:s", strtotime($udate));
$cseid = $_SESSION['course']['cse_id'];
$sql = null;
$dir = "../learning_material/materials";

if (!is_dir($dir)) {
    mkdir($dir);
}

$dir = "../learning_material/materials/" . $_SESSION['course']['cse_full_name'];
// print_r($_FILES['material']);
if ($_FILES['material']['error'] != 4) {
    $allowed_types = array('txt', 'pdf', 'doc', 'docx', 'jpg', 'jpeg', 'svg', 'png', 'gif', 'mp3', 'mp4', 'mkv', 'ogg', 'wav',);
    $file_extension = strtolower(pathinfo($_FILES['material']['name'], PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_types)) {

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $path = "$dir/" . $_FILES['material']['name'];

        move_uploaded_file($_FILES['material']['tmp_name'], $path);

        $sql = "insert into learning_material (lm_name, lm_type, lm_desc, lm_upload_date_time, lm_file, cse_id) values ('$name', '$file_extension', '$desc', '$udate', '$path', '$cseid')";
    } else {
        echo "Error: Only TXT, PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, MP3, MP4, MKV, OGG, and WAV files are allowed.";
?>
        <script>
            alert("Only  TXT, PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, MP3, MP4, MKV, OGG, and WAV files are allowed.");
        </script>
<?php
    }
} else {
    $sql = "insert into learning_material (lm_name, lm_desc, lm_upload_date_time, cse_id) values ('$name', '$desc', '$udate', '$cseid')";
}

if (mysqli_query($conn, $sql)) {
    echo "Learning material added";
} else {
    echo mysqli_error($conn);
}

header("location:{$_SERVER['HTTP_REFERER']}");

?>