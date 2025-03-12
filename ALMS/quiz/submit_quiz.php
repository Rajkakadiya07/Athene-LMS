<html>

<head>

</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">

    <?php
    session_start();
    require_once "../connection.php";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentId = $_SESSION['userid'];
        $quizId = $_POST['qui_id'];
        $cseId = $_SESSION['course']['cse_id'];

        // Initialize variables for obtained marks and total marks
        $obtainedMarks = 0;
        $totalMarks = 0;


        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') !== false) {
                $questionId = substr($key, 9);


            //$answerSql = "SELECT ques_correctanswer, ques_answer, ques_marks, ans_id FROM question_answers 
            // JOIN question ON question_answers.ques_id = question.ques_id 
            // WHERE question_answers.ques_id = $questionId AND question_answers.ques_correctanswer = 1";
             
            $answerSql = "SELECT ans_id, ques_answer, ques_correctanswer, ques_marks FROM question_answers 
            JOIN question ON question_answers.ques_id = question.ques_id 
            WHERE question_answers.ques_id = $questionId AND question_answers.ques_correctanswer = 1";


            $answerResult = $conn->query($answerSql);

                $quizInfoSql = "SELECT qui_total_marks FROM quiz WHERE qui_id = $quizId";
                $quizInfoResult = $conn->query($quizInfoSql);

                if ($answerResult->num_rows > 0) {
                    $answerRow = $answerResult->fetch_assoc();
                    $correctAnswer = $answerRow['ques_correctanswer'];
                    $questionMarks = $answerRow['ques_marks'];
                    $ques_answer = $answerRow['ques_answer'];
                    $ans_id = $answerRow['ans_id'];


                    $quizInfoRow = $quizInfoResult->fetch_assoc();



                    // Debugging: Output correct answer, selected answer, and question marks
                    echo "Question ID:" . $questionId . "<br>";
                    echo " correct options:" . $ques_answer . "<br>";
                    echo "Correct Answer:" . $correctAnswer . "<br>";
                    echo  "Selected Answer:" . $value . "<br>";
                    echo " Marks:" . $questionMarks . "<br>";



                    // Check if the selected answer matches the correct answer
                    if ($value == $ques_answer) {
                        // If the answer is correct, increment total marks and obtained marks
                        $obtainedMarks += $questionMarks;
                    }
                    $insertScoreSql = "INSERT INTO student_quiz_score (stud_id, ans_id, ques_id, qui_id, cse_id)
                VALUES ('$studentId', '$ans_id', '$questionId', '$quizId', '$cseId')";

                    if ($conn->query($insertScoreSql) === TRUE) {
                        echo "Student quiz score inserted successfully for question $questionId.<br>";
                    } else {
                        echo "Error inserting student quiz score for question $questionId: " . $conn->error . "<br>";
                    }
                    $totalMarks = $quizInfoRow['qui_total_marks'];
                } else {
                    echo "Error: Correct answer not found for question $questionId.<br>";
                }
            }
        }

        // Debugging: Output obtained marks and total marks
        echo "Obtained Marks: $obtainedMarks, Total Marks: $totalMarks<br>";
 $updateAttendanceSql = "UPDATE student_attempted_quiz SET attended = 1 WHERE stud_id = '$studentId' AND qui_id = $quizId AND cse_id = $cseId";
    
                if ($conn->query($updateAttendanceSql) === TRUE) {
                    echo "Attended updated successfully for student $studentId.<br>";
                } else {
                    echo "Error updating Attended for student $studentId: " . $conn->error . "<br>";
                }

        // Insert data into quiz_result table
        $resultSql = "INSERT INTO quiz_result (cse_id, stud_id, qui_id, tot_marks, obtn_marks, obtn_grade, result_date)
                  VALUES ('$cseId', '$studentId', '$quizId', '$totalMarks', '$obtainedMarks', NULL, NOW())";

        if ($conn->query($resultSql) === TRUE) {
            echo "Quiz result inserted successfully.<br>";

                $quizId = $_POST['qui_id'];
               
             header("Location: quiz_result.php?quizId=$quizId");

                // echo "Student quiz score inserted successfully.<br>";
                // exit();
            // } else {
            //     echo "Error inserting student quiz score: " . $conn->error . "<br>";
            // }

            // Redirect to quiz result page after inserting the result
            // header("Location: ./quiz_result.php");
        } else {
            echo "Error inserting quiz result: " . $conn->error . "<br>";
        }
    } else {
        echo "Invalid request method.";
    }

    $conn->close();
    ?>
    <script type="text/javascript">
        function noBack() {
            window.history.forward();
        }

        // Additional code to prevent backspace key from navigating back
        document.addEventListener('keydown', function(event) {
            const forbiddenKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'];
            if (forbiddenKeys.includes(event.key)) {
                event.preventDefault();
            }
        });
    </script>

</body>

</html>