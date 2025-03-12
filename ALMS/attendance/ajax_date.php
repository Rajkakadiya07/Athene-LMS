<?php
require_once "../connection.php";
$sql = "select cse_start_date,  cse_end_date from course where cse_id = {$_POST['cseid']}";
if(($result = mysqli_query($conn, $sql)) !== false){
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $dates['start'] = $row['cse_start_date'];
        $dates['end'] = $row['cse_end_date'];
    }
}
echo json_encode($dates);
?>