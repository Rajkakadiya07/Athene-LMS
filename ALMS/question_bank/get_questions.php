<?php
session_start();
require_once "../connection.php";

if (empty($_POST["category"]) && empty($_POST["topic"]) && empty($_POST["sub_topic"]) && empty($_POST["question"])) {
    $query = "SELECT * FROM question limit 200";
} else {
    $query = "SELECT * FROM question";
    $conditions = array();

    if (!empty($_POST["category"])) {
        $conditions[] = "ques_category = '" . $_POST["category"] . "'";
    }

    if (!empty($_POST["topic"])) {
        $conditions[] = "ques_topic = '" . $_POST["topic"] . "'";
    }

    if (!empty($_POST["subtopic"])) {
        $conditions[] = "ques_sub_topic = '" . $_POST["subtopic"] . "'";
    }

    if (!empty($_POST["question"])) {
        $conditions[] = "ques_text like '%" . $_POST["question"] . "%'";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
}

// echo $query;



$questionNumber = 1;

if ($result = mysqli_query($conn, $query)) {
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $questionText = $row['ques_text'];
            $questionId = $row['ques_id'];
            $questionMarks = $row['ques_marks'];

            $existingOptions = [];
            $correctAnswers = [];
            $existingOptionsQuery = "SELECT ques_answer, ques_correctanswer FROM question_answers WHERE ques_id = '$questionId'";
            if ($existingOptionsResult = mysqli_query($conn, $existingOptionsQuery)) {
                while ($optionRow = mysqli_fetch_assoc($existingOptionsResult)) {
                    $existingOptions[] = $optionRow['ques_answer'];
                    if ($optionRow['ques_correctanswer'] == 1) {
                        $correctAnswers[] = $optionRow['ques_answer'];
                    }
                }
            }

            // <input type='hidden' id='hiddenQuizId' name='quizId' value='$quizId'>
            // Display update form for the question
            echo "
                           <div class='d-flex justify-content-between align-items-center mb-2'>
                               <h4 class='text-dark'>Question $questionNumber</h4>
                               <span class='ml-auto text-dark'>Marks: $questionMarks</span>
                           </div>
                           <input type='hidden' name='questionId' value='$questionId'>
                           <label class='ms-1 form-label text-dark'>Question Text</label>
                           <input type='text' class='form-control mb-2' name='questionText' value='$questionText'>
                           <label class='ms-1 form-label text-dark'>Options</label>";

            // Display existing options and their correct status
            foreach ($existingOptions as $option) {
                echo "<div class='input-group mb-2'>
                               <input type='text' class='form-control' name='options[]' value='$option'>
                               <div class='input-group-append ms-2 mt-1'>
                                   <span class='input-group-text'>
                                       <input type='radio' name='correctAnswer' value='$option' " . (in_array($option, $correctAnswers) ? 'checked' : '') . ">
                                   </span>
                               </div>
                           </div>";
            }

            // Display form buttons
            echo ' <button type="button" class="btn btn-primary mb-2" onclick="updateQuestion()">Update</button>';
            echo ' <button type="button" class="btn btn-danger mb-2" onclick="deleteQuestion(' . $questionId . ')">Delete</button>';
            //   echo "quiz id is :".$quizId;

            $questionNumber++;

        }
    }
}

mysqli_close($conn);
?>