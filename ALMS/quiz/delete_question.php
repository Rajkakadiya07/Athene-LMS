<?php
session_start();
require_once "../connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["questionId"])) {
    $questionId = mysqli_real_escape_string($conn, $_POST["questionId"]);

    // Fetch the marks associated with the deleted question
    $getMarksQuery = "SELECT ques_marks FROM question WHERE ques_id = '$questionId'";
    $getMarksResult = mysqli_query($conn, $getMarksQuery);

    if ($getMarksResult) {
        $marksRow = mysqli_fetch_assoc($getMarksResult);
        $marks = $marksRow['ques_marks'];

        // Fetch the current total marks of the quiz
        $quizId = $_SESSION['quiz']['qui_id'];
        $getTotalMarksQuery = "SELECT qui_total_marks FROM quiz WHERE qui_id = '$quizId'";
        $getTotalMarksResult = mysqli_query($conn, $getTotalMarksQuery);

        if ($getTotalMarksResult) {
            $totalMarksRow = mysqli_fetch_assoc($getTotalMarksResult);
            $currentTotalMarks = $totalMarksRow['qui_total_marks'];

            // Calculate the new total marks after deleting the question
            $newTotalMarks = $currentTotalMarks - $marks;

            // Update the total marks in the quiz table
            $updateTotalMarksQuery = "UPDATE quiz SET qui_total_marks = '$newTotalMarks' WHERE qui_id = '$quizId'";
            $updateTotalMarksResult = mysqli_query($conn, $updateTotalMarksQuery);

            if ($updateTotalMarksResult) {
                // Delete question from the question table
                $deleteQuestionQuery = "DELETE FROM question WHERE ques_id = '$questionId'";
                $deleteQuestionResult = mysqli_query($conn, $deleteQuestionQuery);

                if (!$deleteQuestionResult) {
                    echo json_encode(["status" => "error", "message" => "Error deleting question: " . mysqli_error($conn)]);
                    exit;
                }

                // Delete corresponding options from the question_answers table
                $deleteOptionsQuery = "DELETE FROM question_answers WHERE ques_id = '$questionId'";
                $deleteOptionsResult = mysqli_query($conn, $deleteOptionsQuery);

                if (!$deleteOptionsResult) {
                    echo json_encode(["status" => "error", "message" => "Error deleting options: " . mysqli_error($conn)]);
                    exit;
                }

                echo json_encode(["status" => "success", "message" => "Question deleted successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error updating total marks: " . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error fetching total marks: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error fetching question marks: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

mysqli_close($conn);
?>
