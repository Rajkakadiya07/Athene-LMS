<?php 
require_once "../connection.php";

$sql = "SELECT DISTINCT stu.stud_id, att_date, att_status FROM attendance att, student stu, category cat, course cou
WHERE  cou.cse_id = 1 
AND att.cse_id = cou.cse_id
AND att_date BETWEEN 20210405 AND 20210420 
AND att.stud_id = stu.stud_id order by att_date;";

// $result = mysqli_query($conn, $sql);
// if($result->num_rows > 0){
//     while($row = mysqli_fetch_array($result)){
//         echo "{$row[0]} , {$row[1]}, {$row[2]}, {$row[3]}}<br>";
//     }
// }


// $sql = "CALL GetAttendanceByCourse(1, 1, 20210405, 20210420)";
?>

