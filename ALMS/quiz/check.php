<?php
$quizId = isset($_GET['quizId']) ? intval($_GET['quizId']) : 0;

   $studentId = $_SESSION['userid'];
   $attendanceCheckSql = "SELECT attended FROM student_attempted_quiz WHERE stud_id = '$studentId' AND qui_id = $quizId";
   $attendanceResult = mysqli_query($conn, $attendanceCheckSql);
   $attendanceRow = mysqli_fetch_assoc($attendanceResult);

   if ($attendanceRow['attended'] == 1) {
     header('location:./quiz_result.php?quizId='.$quizId);
  } 

?>