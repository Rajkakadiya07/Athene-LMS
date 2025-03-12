<?php
session_start();
require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $quesCategory = mysqli_real_escape_string($conn, $_POST['ques_category']);
    $quesTopic = mysqli_real_escape_string($conn, $_POST['ques_topic']);
    $quesSubTopic = mysqli_real_escape_string($conn, $_POST['ques_sub_topic']);
    $quesMarks = mysqli_real_escape_string($conn, $_POST['ques_mark']);
    $quesText = mysqli_real_escape_string($conn, $_POST['questionName']);
    $quesCorrectAnswer = mysqli_real_escape_string($conn, $_POST['ques_correct_answer']);
    $quizId = mysqli_real_escape_string($conn, $_GET['quizId']);
    // Insert question into the question table
    $insertQuestionQuery = "INSERT INTO question (ques_category, ques_topic, ques_sub_topic, ques_creation_datetime, ques_marks, ques_text) 
                            VALUES ('$quesCategory', '$quesTopic', '$quesSubTopic', NOW(), '$quesMarks', '$quesText')";
    if (mysqli_query($conn, $insertQuestionQuery)) {
        $quesId = mysqli_insert_id($conn);

        // Insert options and correct answer into question_answer table
        $quesAnswers = $_POST['ques_answer'];
        foreach ($quesAnswers as $key => $answer) {
            $answer = mysqli_real_escape_string($conn, $answer);
            $isCorrect = ($key + 1 == $quesCorrectAnswer) ? 1 : 0;

            $quizId = mysqli_real_escape_string($conn, $_GET['quizId']);
            $insertAnswerQuery = "INSERT INTO question_answers (ques_id, ques_answer, ques_correctanswer) 
            VALUES ('$quesId', '$answer', '$isCorrect')";
            mysqli_query($conn, $insertAnswerQuery);
        }

        // Insert the question ID into quiz_questions table
        $quizId = mysqli_real_escape_string($conn, $_GET['quizId']); // Replace YOUR_QUIZ_ID with the actual quiz ID
        $insertQuizQuestionQuery = "INSERT INTO quiz_questions (qui_id, ques_id) VALUES ('$quizId', '$quesId')";
        mysqli_query($conn, $insertQuizQuestionQuery);

        $calculateTotalMarksQuery = "SELECT SUM(ques_marks) AS total_marks FROM question WHERE ques_id IN (SELECT ques_id FROM quiz_questions WHERE qui_id = '$quizId')";
        $result = mysqli_query($conn, $calculateTotalMarksQuery);
        $row = mysqli_fetch_assoc($result);
        $totalMarks = $row['total_marks'];
        $updateTotalMarksQuery = "UPDATE quiz SET qui_total_marks = '$totalMarks' WHERE qui_id = '$quizId'";
        mysqli_query($conn, $updateTotalMarksQuery);
        
        // Update ques_quiz_occurrences in question table if needed
        $updateOccurrencesQuery = "UPDATE question SET ques_quiz_occurrences = ques_quiz_occurrences + 1 WHERE ques_id = $quesId";
        mysqli_query($conn, $updateOccurrencesQuery);

        // Redirect to a success page or perform other actions after insertion
        // header("Location: quiz_details.php");
        echo "question inserted";
        exit();
    } else {
        // Handle errors (e.g., display an error message)
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
