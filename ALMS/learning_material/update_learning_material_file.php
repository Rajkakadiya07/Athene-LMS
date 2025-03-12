<?php
session_start();

if (!empty($_FILES['attachment']['name'])) {

    $allowed_types = array('txt', 'pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'mkv', 'ogg', 'wav', );
    $file_extension = strtolower(pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION));

    if (in_array($file_extension, $allowed_types)) {


        $dir = "../learning_material/materials/" . $_SESSION['course']['cse_full_name'];
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $file = $_FILES['attachment']['tmp_name'];
        $filepath = $dir . "/" . $_FILES['attachment']['name'];
        move_uploaded_file($file, $filepath);

        require_once '../connection.php';
        $sql = "update learning_material set lm_type = '$file_extension', lm_file = '{$filepath}' where lm_id = {$_SESSION['LM']['lm_id']}";

        if (mysqli_query($conn, $sql)) {
            echo "Updated file";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo "Error: Only TXT, PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, MP3, MP4, MKV, OGG, and WAV files are allowed.";
        ?>
        <script>
            alert("Only  TXT, PDF, DOC, DOCX, JPG, JPEG, PNG, GIF, MP3, MP4, MKV, OGG, and WAV files are allowed.");
        </script>
        <?php
    }
}

header("location:{$_SERVER['HTTP_REFERER']}");
?>