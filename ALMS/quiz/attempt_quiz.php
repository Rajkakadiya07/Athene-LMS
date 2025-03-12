<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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
/* Default styles for all screens */
body {
    overflow-x: hidden;
}

/* Media query for screens smaller than 768px */
@media (max-width: 767px) {
    body {
        font-size: 14px;
    }

    .card-title {
        font-size: 18px;
    }

    .question-card h5 {
        font-size: 18px;
    }

    .question-card p {
        font-size: 16px;
    }

    .form-check-label {
        font-size: 14px;
    }
}

/* Media query for screens between 768px and 991px */
@media (min-width: 768px) and (max-width: 991px) {
    .card {
        font-size: 16px;
    }

    .question-card h5 {
        font-size: 20px;
    }

    .question-card p {
        font-size: 18px;
    }

    .form-check-label {
        font-size: 16px;
    }
}

/* Media query for screens larger than 992px */
@media (max-width: 768px) {
            .card {
                margin: 10px 0;
            }
        }

  @media (max-width: 767px) {
            .card-title {
                font-size: 1rem;
            }

            .place-card__content_header {
                margin-bottom: 0.5rem;
            }

            .card-icon {
                font-size: 40px;
            }

            .dropdown-menu {
                min-width: 150px;
            }
        }
        
    </style>
</head>

<body>
    <?php
  
    require_once "../connection.php";

    require("../header.php");
    require("../sidebar.php");
    //require("./check.php");

    $quizId = isset($_GET['quizId']) ? intval($_GET['quizId']) : 0;


    if ($quizId <= 0) {
        echo "Invalid quiz ID.";
        exit;
    }

   
                                  
                                    
    $quizNameSql = "SELECT qui_name, qui_start_time, qui_end_time FROM quiz WHERE qui_id = $quizId";
    $quizNameResult = $conn->query($quizNameSql);

    if ($quizNameResult->num_rows > 0) {
        $quizNameRow = $quizNameResult->fetch_assoc();
        $quizName = $quizNameRow['qui_name'];
        $startTime = $quizNameRow['qui_start_time'];
        $endTime = $quizNameRow['qui_end_time'];
    } else {
        echo "Quiz not found.";
        exit;
    }
    $sql = "SELECT DISTINCT q.ques_id, q.ques_text
            FROM question q
            INNER JOIN quiz_questions qq ON q.ques_id = qq.ques_id
            WHERE qq.qui_id = $quizId";

    $result = $conn->query($sql);
    $questionNumber = 1;


    date_default_timezone_set('Asia/Kolkata');
    $quizInfoSql = "SELECT qui_name, qui_start_time, qui_end_time FROM quiz WHERE qui_id = $quizId";
    $quizInfoResult = $conn->query($quizInfoSql);

    if ($quizInfoResult->num_rows > 0) {
        $quizInfoRow = $quizInfoResult->fetch_assoc();
        $quizName = $quizInfoRow['qui_name'];
        $startTime = $quizInfoRow['qui_start_time'];
        $endTime = $quizInfoRow['qui_end_time'];
    } else {
        echo "Quiz not found.";
        exit;
    }

    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./Admin.php"> Home</a></li>
                    <li class="breadcrumb-item active"><a href="./Admin.php">Dashboard</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
        <div class="card ms-3 col-11 m-1 ">
                <div class="row">
                    <div class="row">
                        <div class="col-sm">

                            <h5 class="card-title ms-3"><i class="bi bi-folder2"></i> <?php echo $quizName; ?></h5>
                        </div>
                            <div class="col-sm">
                            </div>


                        <div class="col-sm ms-5" id="timer">
                            <h6 class="card-title ms-5"><i class="bi bi-clock"></i> Time Remaining: <span class="text-danger ms-2" id="time"></span></h5>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <?php if ($result->num_rows > 0) : ?>
            <div class="row">
            <div class="card col-11 mt-3 col-lg-8 col-md-6 col-sm-10 ms-3 question"> 
                    <div class="card-body mt-3">
                    <form id="quizForm" action="./submit_quiz.php?quizId=<?= $_GET['quizId'] ?>" method="POST">
                            <!-- Add hidden input fields to store data -->
                            <input type="hidden" name="stud_id" value="<?php echo $_SESSION['userid']; ?>">
                            <input type="hidden" name="qui_id" value="<?php echo $quizId; ?>">
                            <?php $questionNumber = 1; // Initialize question number 
                            ?>

                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <?php
                                $questionId = $row['ques_id'];
                                $questionText = $row['ques_text'];
                                $optionsSql = "SELECT ques_answer FROM question_answers WHERE ques_id = $questionId";
                                $optionsResult = $conn->query($optionsSql);
                                $options = [];

                                while ($optionRow = $optionsResult->fetch_assoc()) {
                                    $options[] = $optionRow['ques_answer'];
                                }
                                ?>

                                <div class="mb-3 question-card <?php echo $questionNumber === 1 ? '' : 'd-none'; ?>">
                                    <h5 class="text-dark ms-1">Question <?php echo $questionNumber; ?></h5>
                                    <p class="h3 ms-1 text-dark"><?php echo $questionText; ?></p>
                                    <div class="list-group" id="optionsList">
                                        <?php foreach ($options as $option) : ?>
                                            <div class="list-group-item list-group-item-action">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="question_<?php echo $questionId; ?>" value="<?php echo $option; ?>" id="flexRadioDefault">
                                                    <label class="form-check-label" for="flexRadioDefault"><?php echo $option; ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <?php $questionNumber++; // Increment question number 
                                ?>
                            <?php endwhile; ?>

                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" id="prevButton">Previous</button>
                                    <button type="button" class="btn btn-success" id="nextButton">Next</button>
                                    <button type="submit" class="btn btn-success" id="submitQuizButton">Submit Quiz</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Question Navigation Card -->
                <div class="row col-11 card col-lg-3 ms-2 col-md-3 col-sm-3 ms-3 mt-3 ">
                    <div class="card-body">
                        <h5 class="card-title">Question Navigation</h5>
                        <div class="btn-group d-flex flex-wrap">
                            <?php
                            $totalQuestions = $result->num_rows;

                            // Calculate the number of columns for quiz navigation buttons based on the total number of questions
                            $numColumns = $totalQuestions > 5 ? 5 : $totalQuestions;

                            for ($i = 1; $i <= $totalQuestions; $i++) :
                                $buttonClass = $i === 1 ? 'btn-success' : ''; // Add 'btn-success' class to the first button
                            ?>
                                <button type="button" class="m-1 btn btn-secondary question-nav-btn <?php echo $buttonClass; ?>" data-question="<?php echo $i; ?>"><?php echo $i; ?></button>
                            <?php
                                if ($i % $numColumns === 0 && $i !== $totalQuestions) {
                                    echo '<br>'; // Add a line break after every $numColumns buttons except the last batch
                                }
                            endfor;
                            ?>
                        </div>
                    </div>
                </div>


                <?php if ($totalQuestions > 0) : ?>
                <?php else : ?>
                <?php endif; ?>
            </div>

            <script>
                const endTime = new Date("<?php echo $endTime; ?>").getTime();

                // Update the countdown every second
                const countdown = setInterval(function() {
                    // Get the current time
                    const now = new Date().getTime();

                    // Calculate the remaining time in milliseconds
                    const distance = endTime - now;

                    // Calculate hours, minutes, and seconds
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);


                    document.getElementById("time").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

                    // If the countdown is over, display a message and clear the interval
                    if (distance < 0) {
                        clearInterval(countdown);
                        document.getElementById("time").innerHTML = "Time's up!";
                        // Optionally, you can submit the quiz automatically when time is up
                        document.getElementById("quizForm").submit();
                    }
                }, 1000);


                let currentQuestion = 0;
                const questionCards = document.querySelectorAll('.question-card');
                const questionNavButtons = document.querySelectorAll('.question-nav-btn');
                const nextButton = document.getElementById('nextButton');
                const prevButton = document.getElementById('prevButton');
                const submitButton = document.getElementById('submitQuizButton');
                const answeredQuestions = Array.from({
                    length: questionCards.length
                }, () => false);

                function updateButtonVisibility() {
                    if (currentQuestion === 0) {
                        prevButton.classList.add('d-none');
                    } else {
                        prevButton.classList.remove('d-none');
                    }

                    if (currentQuestion === questionCards.length - 1) {
                        nextButton.classList.add('d-none');
                        submitButton.classList.remove('d-none');
                    } else {
                        nextButton.classList.remove('d-none');
                        submitButton.classList.add('d-none');
                    }
                }

                updateButtonVisibility();

                
                questionNavButtons.forEach((button, index) => {
                    button.addEventListener('click', () => {
                        currentQuestion = index;
                        questionCards.forEach(card => {
                            card.classList.add('d-none');
                        });
                        questionCards[currentQuestion].classList.remove('d-none');
                        updateButtonVisibility();
                    });
                });

                nextButton.addEventListener('click', () => {
                    if (currentQuestion < questionCards.length - 1) {
                        questionCards[currentQuestion].classList.add('d-none');
                        currentQuestion++;
                        questionCards[currentQuestion].classList.remove('d-none');
                        updateButtonVisibility();
                    }
                });

                prevButton.addEventListener('click', () => {
                    if (currentQuestion > 0) {
                        questionCards[currentQuestion].classList.add('d-none');
                        currentQuestion--;
                        questionCards[currentQuestion].classList.remove('d-none');
                        updateButtonVisibility();
                    }
                });

                // Add event listener for radio button change
                const radioButtons = document.querySelectorAll('.form-check-input');
                radioButtons.forEach((button, index) => {
                    button.addEventListener('change', () => {
                        // Add a class to the selected question navigation button
                        questionNavButtons[currentQuestion].classList.add('btn-success');
                        answeredQuestions[currentQuestion] = true;
                    });
                });

                // Initialize question navigation buttons based on answered questions
                answeredQuestions.forEach((answered, index) => {
                    if (answered) {
                        questionNavButtons[index].classList.add('btn-success');
                    }
                });
            </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const listViewItems = document.querySelectorAll('.list-view-item');
    const radioButtons = document.querySelectorAll('.form-check-input');

    listViewItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            setCurrentQuestion(index);

            // Uncheck all radio buttons before checking the selected one
            radioButtons.forEach(button => {
                button.checked = false;
            });

            // Check the corresponding radio button based on the clicked list view item
            const radioButton = document.querySelector(`input[name="question_${index + 1}"]`);
            if (radioButton) {
                radioButton.checked = true;
                questionNavButtons[index].classList.add('btn-success');
                answeredQuestions[index] = true;
            }
        });
    });
});


</script>

<?php require_once "../js.php" ?>

        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                No questions available for this quiz.
            </div>
        <?php endif; ?>
    </main>

    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTab"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">






</body>

</html>