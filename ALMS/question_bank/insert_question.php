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
    $quesAnswers = $_POST['ques_answer'];

    if ($quesCategory == '') {
        $quesCategory = null;
    }
    if ($quesTopic == '') {
        $quesTopic = null;
    }
    if ($quesSubTopic == '') {
        $quesSubTopic = null;
    }

    if (
        !empty($quesMarks) && !empty($quesText) && !empty($quesCorrectAnswer)
        && $quesMarks > 0 && $quesText != '' && $quesCorrectAnswer > 0 && $quesCorrectAnswer <= count($quesAnswers)
    ) {

        // Insert question into the question table
        $insertQuestionQuery = "INSERT INTO question (ques_category, ques_topic, ques_sub_topic, ques_creation_datetime, ques_marks, ques_text) 
                            VALUES ('$quesCategory', '$quesTopic', '$quesSubTopic', NOW(), '$quesMarks', '$quesText')";
        if (mysqli_query($conn, $insertQuestionQuery)) {
            $quesId = mysqli_insert_id($conn);

            // Insert options and correct answer into question_answer table
            foreach ($quesAnswers as $key => $answer) {
                $answer = mysqli_real_escape_string($conn, $answer);
                $isCorrect = ($key + 1 == $quesCorrectAnswer) ? 1 : 0;

                $insertAnswerQuery = "INSERT INTO question_answers (ques_id, ques_answer, ques_correctanswer) 
            VALUES ('$quesId', '$answer', '$isCorrect')";
                mysqli_query($conn, $insertAnswerQuery);
            }
            // header("Location: quiz_details.php");
            echo "question inserted";
            exit();
        } else {
            // Handle errors (e.g., display an error message)
            echo "Error: " . mysqli_error($conn);
        }
    }


    // Close the database connection
    mysqli_close($conn);
}
