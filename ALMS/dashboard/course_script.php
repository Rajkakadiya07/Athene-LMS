<?php
// course_script.php
require_once "../connection.php";

$sql = "SELECT COUNT(*) AS count FROM course";

$result = mysqli_query($conn, $sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['count']; // Echo the count of courses
} else {
    echo "0"; // Echo 0 if no courses found
}

mysqli_close($conn);
?>
