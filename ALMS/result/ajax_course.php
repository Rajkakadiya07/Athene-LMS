<?php
require_once "../connection.php";
$options = "<option value='' selected>Select</option>";
$sql = "select * from course where cat_id = {$_POST['id']}";
$result = mysqli_query($conn, $sql);
if (!empty($result->num_rows) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['cse_id']}'>{$row['cse_full_name']} ({$row['cse_short_name']})</option>";
    }
}
echo $options;
?>
