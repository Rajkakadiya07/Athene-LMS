<?php
session_start();
require_once "../connection.php";

if (isset($_GET['deleteQuiz'])) {
    $quizId = $_GET['deleteQuiz'];

    // Perform the SQL delete operation
    $sql = "DELETE FROM quiz WHERE qui_id = $quizId";
    $result = mysqli_query($conn, $sql);
    echo $sql;
    header("location:../course/course_view.php?cseId={$_SESSION['course']['cse_id']}");
    exit();
}
?>