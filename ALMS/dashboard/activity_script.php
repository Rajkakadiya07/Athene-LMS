<?php
// activity_script.php
require_once "../connection.php";

$sql = "SELECT COUNT(*) AS count FROM (
    SELECT agn_id FROM assignment
    UNION
    SELECT lm_id FROM learning_material
    UNION 
    SELECT qui_id FROM quiz 
) AS combined_table";

$result = mysqli_query($conn, $sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['count']; // Echo the count of activities
} else {
    echo "0"; // Echo 0 if no activities found
}

mysqli_close($conn);
?>
