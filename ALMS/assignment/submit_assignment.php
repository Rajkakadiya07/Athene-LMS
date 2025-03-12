<?php
session_start();

date_default_timezone_set('Asia/Kolkata');

$dir = "../assignment/submissions";
if (!is_dir($dir)) {
    mkdir($dir);
}

require_once "../connection.php";
$dir = "./submissions/" . $_SESSION['course']['cse_full_name'];
echo $dir . "<br>";
if (!empty($_FILES['submission'])) {
    if (!is_dir($dir)) {
        mkdir($dir);
    }

    $allowed_types = array('txt', 'pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'gif');
    $file_extension = strtolower(pathinfo($_FILES['submission']['name'], PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_types)) {
        echo "Error: Only TXT, PDF, DOC, DOCX, JPG, JPEG, PNG and GIF files are allowed.";
?>
        <script>
            alert("Only  TXT, PDF, DOC, DOCX, JPG, JPEG, PNG and GIF files are allowed.");
        </script>
<?php
    } else {
        $tmp = $_FILES['submission']['tmp_name'];
        $filename = $_FILES['submission']['name'];
        $path = $dir . "/" . $_SESSION['course']['cse_id'] . $_SESSION['assignment']['agn_id'] . " " . $filename;
        echo $path . "<br>";

        move_uploaded_file($tmp, $path);
        $sql = "update assignment_submission set agn_submission_date_time = '" . date('Y-m-d H:i:s', time()) . "', agn_submission_file = '$path', agn_submission_status = 1 " .
            "where agn_id = {$_SESSION['assignment']['agn_id']} and stud_id = '{$_SESSION['userid']}'";
        if (mysqli_query($conn, $sql)) {
            echo "added to db";
        } else {
            echo mysqli_error($conn);
        }
    }
}
// echo date('Y-m-d h:i:s A', time());

header("location:{$_SERVER['HTTP_REFERER']}");

?>