<html>

<head>
    <style>
        .scrollable-form-container {
            max-height: 590px;
            overflow-y: auto;
            padding: 10px;
        }
        body {
            font-size: 16px;
        }

        @media (max-width: 767px) {
            body {
                font-size: 14px;
            }

            .modal-body {
                padding: 2rem;
            }

            .scrollable-form-container {
                max-height: 400px;
            }

            .form-label {
                font-size: 14px;
            }

            .form-control {
                font-size: 14px;
            }

            .modal-dialog {
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .content-info {
                font-size: 12px;
                text-align: center;
                margin-top: 10px;
            }
        }
    </style>
</head>

</html>
<div class="modal fade bd-example-modal-lg " id="sModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="bi bi-check2-circle text-success h1"></i>
                    <p class="mt-2 h2 text-success">Question Updated Successfully</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="EModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="bi bi-exclamation-triangle text-danger h1"></i>
                    <p class="mt-2 h4 text-danger" id="errorModalText"></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg " id="sdModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="bi bi-check2-circle text-success h1"></i>
                    <p class="mt-2 h2 text-success">Question Deleted Successfully</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="scrollable-form-container">
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
                echo "<div class='text-dark  ms-1'>Total Questions: $totalQuestions <span class='float-end'>Total Marks: $totalMarks</span></div>";
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
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                $questionText = $row['ques_text'];
                $questionId = $row['ques_id'];
                $questionMarks = $row['ques_marks'];

                if (!in_array($questionId, $printedQuestions)) {
                    // Fetch existing options for the question
                    $existingOptionsQuery = "SELECT ans_id, ques_answer, ques_correctanswer FROM question_answers WHERE ques_id = '$questionId'";
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
                    echo "<form method='post' action='#' id='questionForm$i' class='mt-3'>
                   <input type='hidden' id='hiddenQuizId' name='quizId' value='$quizId'>
                           <div class='d-flex justify-content-between align-items-center mb-2'>
                               <h4 class='text-dark'>Question $questionNumber</h4>
                               <span class='ml-auto text-dark'>Marks: $questionMarks</span>
                           </div>
                        
                           <input type='hidden' name='questionId' value='' . $questionId . ''>
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
                    echo " <button type='button' class='btn btn-primary mb-2' id='update$i' onclick='updateQuestion(this)'>Update</button>";
                    echo " <button type='button' class='btn btn-danger mb-2' onclick='deleteQuestion($questionId)'>Delete</button>

                       </form>";

                    //   echo "quiz id is :".$quizId;
    
                    $questionNumber++;
                    $printedQuestions[] = $questionId;
                    $i++;

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

</div>
<script>
    var quizId = $('#hiddenQuizId').val();

    function loadQuestions(quizId) {
        $.ajax({
            type: 'GET',
            url: 'load_questions.php?quizId=' + quizId,
            success: function (response) {
                $('#questionsContainer').html(response);
            },
            error: function (error) {
                // Handle errors (if needed)
                console.error('Error occurred while loading questions:', error);
            }
        });
    }

    function displayErrorModal(errorMessage) {
        $('#errorModalText').text(errorMessage); // Set the error message inside the modal
        $('#ErrorModal').modal('show'); // Show the ErrorModal
    }

    function updateQuestion(btn) {
        var slicedString = btn.id.slice(6);
        // console.log(btn);
        // console.log(slicedString);
        var questionText = $("input[name='questionText']").val();
        var options = $("input[name='options[]']").map(function () {
            return $(this).val();
        }).get();
        var correctAnswer = $("input[name='correctAnswer']:checked").val();

        // Validation: Check if question text and options are not empty
        if (questionText.trim() === "") {
            displayErrorModal("Question text cannot be empty.");
            return;
        }

        for (var i = 0; i < options.length; i++) {
            if (options[i].trim() === "") {
                displayErrorModal("Option " + (i + 1) + " cannot be empty.");
                return;
            }
        }

        if (correctAnswer === undefined) {
            displayErrorModal("Please select a correct answer.");
            return;
        }
        form = document.getElementById("questionForm" + slicedString);
        console.log(form);
        var formData = new FormData(form);
        formData.append("updateQuestion", true);
        // Append the correctAnswer value to the formData
        formData.append("correctAnswer", $("input[name='correctAnswer']:checked").val());

        $.ajax({
            type: "POST",
            url: "update_question.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#sModal').modal('show');
                console.log(response);

                // loadQuestions(quizId);
            }
        });

    }

    $(document).ready(function () {

        //  loadQuestions(quizId);


    });

    function deleteQuestion(questionId) {
        console.log("Deleting question with ID: " + questionId);

        var formData = new FormData();
        formData.append("questionId", questionId);
        formData.append("deleteQuestion", true);

        $.ajax({
            type: "POST",
            url: "delete_question.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#sdModal').modal('show');
                console.log(response);
                loadQuestions(quizId);
            }
        });

    }
</script>