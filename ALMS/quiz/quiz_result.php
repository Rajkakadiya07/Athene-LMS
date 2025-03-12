<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        /* Default font size for all screens */
body {
    font-size: 16px; /* Default font size */
}

/* Media query for screens smaller than 768px */
@media (max-width: 767px) {
    body {
        font-size: 13px; /* Adjusted font size for smaller screens */
    }

    /* Additional elements and their font sizes for smaller screens */
    .h1-class {
        font-size: 14px; /* Example: Heading 1 font size for smaller screens */
    }

    .paragraph-class {
        font-size: 12px; /* Example: Paragraph font size for smaller screens */
    }

    /* Add more styles for other elements as needed */
}

    </style>
</head>

<body>
    <?php
    

    require("../header.php");
    require("../sidebar.php");
    require_once "../connection.php";
    $quizId = $_GET['quizId'];

    // Fetch total marks and obtained marks from the database
    $sql = "SELECT tot_marks, obtn_marks FROM quiz_result WHERE stud_id = '{$_SESSION['userid']}' AND qui_id = '$quizId'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalMarks = $row['tot_marks'];
        $obtainedMarks = $row['obtn_marks'];

        // Calculate percentage
        $percentage = ($obtainedMarks / $totalMarks) * 100;

        // Check if the percentage is less than 80%
        $resultStatus = $percentage >= 80 ? "Passed" : "Failed";
    } else {
        $percentage = 0; // Default percentage if no data found
        $resultStatus = "Failed"; // Default status if no data found
    }

    
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Admin.php">Home</a></li>
                    <li class="breadcrumb-item active"><a href="./Admin.php">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
        <div class="card col-11 col-md-6 col-lg-11 ms-3">
                <div class="card-body p-10 text-center">
                    <div class="mb-4  ">
                        <?php if ($resultStatus === 'Passed') : ?>
                            <!-- <h2 class="mt-4 text-success">🎉 Congratulations. You passed!</h2>
                            <h5 class="mb-0 px-lg-14 text-success">You have successfully completed the quiz. Now you can click on
                                finish and go back to your quiz page.</h5> -->
                        <?php else : ?>
                            <!-- <h2 class="mt-4 text-danger">Oops! You didn't pass this time.</h2>
                            <h5 class="mb-0 px-lg-14 text-danger">Don't worry, you can review your answers and try again. Click on finish
                                to go back to your quiz page.</h5> -->
                        <?php endif; ?>
                    </div>
                    <!-- chart -->
                    <div class="justify-content-center">
                    </div>
                    <!-- text -->
                    <span class="h6 text-dark">Your Score: <span class="text-<?php echo $resultStatus === 'Passed' ? 'success' : 'danger'; ?>">
                            <?php echo number_format($percentage, 2); ?>% (<?php echo $obtainedMarks; ?> points)</span></span><br>
                    <span class="mt-2 d-block text-dark h6">Passing Score: <span class="text-success">80%</span></span>
                </div>
            </div>
        </div>

        <div class="row">
        <div class="card col-11 col-md-6 col-lg-11 ms-3">
                <div class="card-body mt-3">
                    <?php
                    require_once "../connection.php";

                    if(isset($_GET['quizId'])) {
                        $quizId = $_GET['quizId'];
                        $studentId = $_SESSION['userid'];
                    
                        // Fetch questions and selected options from student_quiz_score table
                        $query = "SELECT q.ques_id, q.ques_text, qa.ques_answer
                                  FROM question q
                                  JOIN question_answers qa ON q.ques_id = qa.ques_id
                                  JOIN student_quiz_score sqs ON q.ques_id = sqs.ques_id
                                  WHERE sqs.stud_id = '$studentId' AND sqs.qui_id = '$quizId'";
                    
                        $result = mysqli_query($conn, $query);
                    
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $questionId = $row['ques_id'];  
                                $questionText = $row['ques_text'];
                                $selectedOption = $row['ques_answer'];
                    
                                // Display the question and selected option
                                // echo "<strong>Question ID:</strong> $questionId<br>";
                                // echo "<strong>Question:</strong> $questionText<br>";
                                // echo "<strong>Selected Option:</strong> $selectedOption<br><br>";
                            }
                        } else {
                            echo "Error fetching data from the database.";
                        }
                    } else {
                        echo "Invalid quiz ID.";
                    }
                    
                    $countQuery = "SELECT COUNT(*) as total_questions FROM quiz_questions where qui_id=$quizId";
                    $countResult = mysqli_query($conn, $countQuery);

                    if ($countResult) {
                        $countRow = mysqli_fetch_assoc($countResult);
                        $totalQuestions = $countRow['total_questions'];

                        if (isset($_GET['quizId'])) {
                            $quizId = mysqli_real_escape_string($conn, $_GET['quizId']);

                            $getTotalMarksQuery = "SELECT qui_total_marks FROM quiz WHERE qui_id = $quizId";
                            $resul = mysqli_query($conn, $getTotalMarksQuery);
                            if ($resul) {
                                // Fetch the total marks from the result set
                                $row = mysqli_fetch_assoc($resul);
                                $totalMarks = $row['qui_total_marks'];

                                // Display the total marks
                                echo "<div class='text-dark h6 ms-1'>Total Questions: $totalQuestions <span class='float-end'>Total Marks: $totalMarks</span></div>";
                            }
                        }
                        $query = "SELECT DISTINCT q.ques_id, q.ques_marks, q.ques_text, q.ques_quiz_occurrences, qa.ques_answer, qa.ques_correctanswer, sqs.ans_id
                    FROM question q
                    JOIN question_answers qa ON q.ques_id = qa.ques_id
                    JOIN quiz_questions qq ON q.ques_id = qq.ques_id
                    LEFT JOIN student_quiz_score sqs ON q.ques_id = sqs.ques_id AND sqs.qui_id = qq.qui_id AND sqs.stud_id = '202103100110134'
                    WHERE qq.qui_id = $quizId";

                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $questionNumber = 1;
                            $printedQuestions = [];

                            while ($row = mysqli_fetch_assoc($result)) {
                                $questionText = $row['ques_text'];
                                $questionId = $row['ques_id'];
                                $questionMark = $row['ques_marks'];
                                $selectedAnswerId = $row['ans_id'];
                                $selectedOptionText = '';
                                if (!in_array($questionId, $printedQuestions)) {
                                    echo '<div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="text-dark">Question ' . $questionNumber . ' : ' . $questionText . '</h4>
                        <span class="ml-auto text-dark">Marks: ' . $questionMark . '</span>
                    </div>
                    <div class="list-group">';

                                    // Loop through options and display them with appropriate styles
                                    $optionsQuery = "SELECT ans_id, ques_answer, ques_correctanswer FROM question_answers WHERE ques_id = '$questionId'";
                                    $optionsResult = mysqli_query($conn, $optionsQuery);
                                   
                                    $optionsQuey = "SELECT student_quiz_score.ans_id, ques_answer, ques_correctanswer FROM question_answers, student_quiz_score WHERE question_answers.ans_id = student_quiz_score.ans_id AND qui_id = $quizId AND stud_id='{$_SESSION['userid']}';";
                                    
                                    if ($optionsResult) {
                                        while ($optionRow = mysqli_fetch_assoc($optionsResult)) {
                                            $optionId = $optionRow['ans_id']; // Add this line to fetch optionId
                                            $optionText = $optionRow['ques_answer'];
                                            $isCorrectAnswer = $optionRow['ques_correctanswer'];



                                            // Determine styles based on correctness and student's selection
                                            $answerStyle = $isCorrectAnswer ? 'style="color: green; font-weight: bold;"' : 'style="color: ; font-weight: bold;"';

                                            // Check if the current option is selected by the student
                                            if ($optionId == $selectedAnswerId) {
                                                $selectedOptionText = $optionText; // Store the selected option
                                            }

                                            // Display the option with the determined style
                                            echo '<div class="list-group-item list-group-item-action">
                                            <label class="form-check-label" for="flexRadioDefault' . $questionId . '" ' . $answerStyle . '>' . $optionText . '</label>
                                          </div>';
                                        }
                                        echo '<h6 style="color: black; font-weight: bold;" class="ms-1 mt-2 text-dark">Selected Option: ' . $optionText . '</h6>';
                                    } else {
                                        echo "Error fetching options from the database.";
                                    }

                                    echo '</div></div>';
                                    $questionNumber++;

                                    $printedQuestions[] = $questionId;
                                }
                            }
                        } else {
                            echo "Error fetching questions from the database.";
                        }
                    }
                    mysqli_close($conn);
                    ?>
                    <div class="mt-3">

                    </div>
                    <div class="mt-5">
                        <button type="button" class="btn btn-success" onclick="location.href='../dashboard/dashboard_student.php';">Finish</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTab"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../assets/js/main.js"></script>
</body>

</html>