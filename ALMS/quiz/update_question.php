<?php

require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get question data from POST request
    $questionId = mysqli_real_escape_string($conn, $_POST['questionId']);
    $questionText = mysqli_real_escape_string($conn, $_POST['questionText']);
    $options = $_POST['options'];
    $correctAnswer = mysqli_real_escape_string($conn, $_POST['correctAnswer']);

    // Start a transaction to ensure data consistency
    mysqli_autocommit($conn, false);

    // Update question text in the database
    $updateQuestionQuery = "UPDATE question SET ques_text = '$questionText' WHERE ques_id = '$questionId'";
    $updateQuestionResult = mysqli_query($conn, $updateQuestionQuery);

    // Delete existing options for the question
    $deleteOptionsQuery = "DELETE FROM question_answers WHERE ques_id = '$questionId'";
    $deleteOptionsResult = mysqli_query($conn, $deleteOptionsQuery);

    // Insert new options and correct answer into question_answers table
    $insertOptionResult = true; // Initialize to true
    foreach ($options as $option) {
        $isCorrectAnswer = ($option === $correctAnswer) ? 1 : 0;
        // Use prepared statements to prevent SQL injection
        $insertOptionQuery = "INSERT INTO question_answers (ques_id, ques_answer, ques_correctanswer) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertOptionQuery);
        mysqli_stmt_bind_param($stmt, "iss", $questionId, $option, $isCorrectAnswer);
        $insertOptionResult = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // If any insert fails, break out of the loop
        if (!$insertOptionResult) {
            break;
        }
    }

    // Commit or rollback the transaction based on the results
    if ($updateQuestionResult && $deleteOptionsResult && $insertOptionResult) {
        mysqli_commit($conn);
        $response = array("status" => "success", "message" => "Question updated successfully.");
    } else {
        mysqli_rollback($conn);
        error_log("Error updating question: " . mysqli_error($conn)); // Log the MySQL error
        $response = array("status" => "error", "message" => "Error updating question: " . mysqli_error($conn));
    }

    // Reset autocommit to true
    mysqli_autocommit($conn, true);

    echo json_encode($response);

} else {
    $response = array("status" => "error", "message" => "Invalid request method.");
    echo json_encode($response);
}

// Close database connection
mysqli_close($conn);
?>
