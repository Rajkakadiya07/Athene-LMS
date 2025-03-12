<?php 
$sql =  "SELECT qui_id AS id, qui_name, qui_start_time AS datetime, 'quiz' AS type FROM quiz WHERE cse_id = ". $_SESSION['course']['cse_id'] . " UNION SELECT poll_id AS id, poll_name, poll_date_time AS datetime, 'poll' AS type
         FROM poll WHERE cse_id = ". $_SESSION['course']['cse_id'] . " ORDER BY datetime DESC";

if($result = mysqli_query($conn, $sql)){
    if (!empty($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['type'] == "quiz") {
                if ($_SESSION['usertype'] == "Admin" || $_SESSION['usertype'] == "Teacher") {
                    echo "<li class='list-group-item mb-3'><a href='../quiz/quiz_details.php?quizId={$row['id']}' class='text-primary'><i class='ri-draft-fill h5 me-1 align-middle'></i>{$row['qui_name']}</a></li>";
                } else if ($_SESSION['usertype'] == "Student") {
                    echo "<li class='list-group-item mb-3'><a href='../quiz/view_quiz.php?quizId={$row['id']}' class='text-primary'><i class='ri-draft-fill h5 me-1 align-middle'></i>{$row['qui_name']}</a></li>";
                }
            } else if ($row['type'] == "poll") {
                echo "<li class='list-group-item mb-3'><a href='../poll/view_poll.php?pollId={$row['id']}' class='text-primary'><i class='ri-draft-fill h5 me-1 align-middle'></i>{$row['qui_name']}</a></li>";
            }
        }
    } else {
        echo "<li class='list-group-item mb-3'>No assessments are added</li>";

    }
}

?>
