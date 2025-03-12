<?php
session_start();
require_once "../connection.php";

$quizId = $_SESSION['quiz']['qui_id'];
$countQuery = "SELECT COUNT(*) as total_questions FROM  quiz_questions WHERE qui_id = $quizId";
$countResult = mysqli_query($conn, $countQuery);

if ($countResult) {
    $countRow = mysqli_fetch_assoc($countResult);
    $totalQuestions = $countRow['total_questions'];

    if (isset($_SESSION['quiz']['qui_id'])) {
        $quizId = $_SESSION['quiz']['qui_id'];

        $getTotalMarksQuery = "SELECT qui_total_marks FROM quiz WHERE qui_id = $quizId";
        $resul = mysqli_query($conn, $getTotalMarksQuery);
        if ($resul) {
            $row = mysqli_fetch_assoc($resul);
            $totalMarks = $row['qui_total_marks'];
            echo "<div class='text-dark h6 ms-1'>Total Questions: $totalQuestions <span class='float-end'>Total Marks: $totalMarks</span></div>";
        }
    }
    $query = "SELECT DISTINCT q.ques_id, q.ques_marks, q.ques_text, q.ques_quiz_occurrences, qa.ques_answer, qa.ques_correctanswer
    FROM question q
    JOIN question_answers qa ON q.ques_id = qa.ques_id
    JOIN quiz_questions qq ON q.ques_id = qq.ques_id
    WHERE qq.qui_id = $quizId";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $questionNumber = 1;
        $printedQuestions = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $questionText = $row['ques_text'];
            $questionId = $row['ques_id'];
            $questionMarks = $row['ques_marks'];

            if (!in_array($questionId, $printedQuestions)) {
                // Fetch existing options for the question
                $existingOptionsQuery = "SELECT ques_answer, ques_correctanswer FROM question_answers WHERE ques_id = '$questionId'";
                $existingOptionsResult = mysqli_query($conn, $existingOptionsQuery);
                $existingOptions = [];
                $correctAnswers = [];
                while ($optionRow = mysqli_fetch_assoc($existingOptionsResult)) {
                    $existingOptions[] = $optionRow['ques_answer'];
                    if ($optionRow['ques_correctanswer'] == 1) {
                        $correctAnswers[] = $optionRow['ques_answer'];
                    }
                }

                // Display update form for the question
                echo '<form method="post" action="#" id="questionForm" class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="text-dark">Question ' . $questionNumber . '</h4>
                            <span class="ml-auto text-dark">Marks: ' . $questionMarks . '</span>
                        </div>
                        <input type="hidden" name="questionId" value="' . $questionId . '">
                        <label class="ms-1 form-label text-dark">Question Text</label>
                        <input type="text" class="form-control mb-2" name="questionText" value="' . $questionText . '">
                        <label class="ms-1 form-label text-dark">Options</label>';

                // Display existing options and their correct status
                foreach ($existingOptions as $option) {
                    echo '<div class="input-group mb-2">
                            <input type="text" class="form-control" name="options[]" value="' . $option . '">
                            <div class="input-group-append ms-2 mt-1">
                                <span class="input-group-text">
                                    <input type="radio" name="correctAnswer" value="' . $option . '" ' . (in_array($option, $correctAnswers) ? 'checked' : '') . '>
                                </span>
                            </div>
                        </div>';
                }

                // Display form buttons
                echo ' <button type="button" class="btn btn-primary mb-2" onclick="updateQuestion()">Update</button>';
                echo ' <button type="button" class="btn btn-danger mb-2" onclick="deleteQuestion(' . $questionId . ')">Delete</button>

                    </form>';
                //   echo "quiz id is :".$quizId;

                $questionNumber++;
                $printedQuestions[] = $questionId;
            }
        }
    } else {
        echo "Error fetching questions from the database.";
    }
} else {
    echo "Error fetching total questions from the database.";
}

mysqli_close($conn);
?>