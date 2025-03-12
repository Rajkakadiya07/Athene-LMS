<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">


    <link href="../assets/css/style.css" rel="stylesheet">

</head>


<body>
    <?php
    session_start();
    require_once("../header.php");
    require_once("../sidebar.php");

    require_once "../connection.php";
    if (isset($_GET['quizId'])) {
        $quizId = mysqli_real_escape_string($conn, $_GET['quizId']);

        $sql = "SELECT * FROM quiz WHERE qui_id = $quizId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $quizName = $row['qui_name'];
                $quizDesc = $row['qui_desc'];
                $startTime = $row['qui_start_time'];
                $endTime = $row['qui_end_time'];
                $totalMarksSql = "SELECT SUM(qui_total_marks) as total_marks FROM quiz WHERE qui_id = $quizId";
                $totalMarksResult = mysqli_query($conn, $totalMarksSql);
                $totalMarksRow = mysqli_fetch_assoc($totalMarksResult);
                $totalMarks = $totalMarksRow['total_marks'];
            } else {
                die("No quiz found for quizId: $quizId");
            }
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        die("No quizId provided in the URL.");
    }
    ?>


    <main id="main" class="main">
        <div class="row">
            <div class="col-xl-11">
                <div class="card">
                    <div class="card-body pt-3">

                        <div class="col-sm">

                            <h5 class="card-title ms-3"><i class="bi bi-folder2">
                                    <?= $quizName ?>
                                </i></h5>
                        </div>
                        <div class="col-sm">
                        </div>
                        <div class="col-sm">
                        </div>
                        <div class="col-sm">
                        </div>
                        <div class="col-sm">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-11">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Quiz Overview</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title ms-3">Quiz Details</h5>

                                    <div class="row ms-2">
                                        <div class="col-lg-3 col-md-4 label text-dark"> Description : </div>
                                        <div class="col-lg-9 col-md-8 text-dark" id="desc-data">
                                            <?= $quizDesc ?>
                                        </div>
                                    </div>
                                    <div class="row ms-2">
                                        <div class="col-lg-3 col-md-4 label text-dark"> Total Marks : </div>
                                        <div class="col-lg-9 col-md-8 text-dark" id="totalmark-data">
                                            <?= $totalMarks ?>
                                        </div>
                                    </div>
                                    <div class="row ms-2">
                                        <div class="col-lg-3 col-md-4 label text-dark">Start Time : </div>
                                        <div class="col-lg-9 col-md-8 text-dark" id="sTime-data">
                                            <?= $startTime ?>
                                        </div>
                                    </div>
                                    <div class="row ms-2">
                                        <div class="col-lg-3 col-md-4 label text-dark">End Time : </div>
                                        <div class="col-lg-9 col-md-8 text-dark" id="eTime-data">
                                            <?= $endTime ?>
                                        </div>
                                    </div>
                                    <div id="quizPasswordContainer" class="mt-3 col-lg-3 col-md-12 mt-2" style="white-space: nowrap; display: none;">
                                    <div class="col-lg-3 col-md-4 ms-3 label text-dark">Quiz Password </div>
                                        <input name="qPassword" type="password" class="ms-3 form-control" id="qPassword">
                                    </div>

                                    <div class="text-center mt-2">
                                        <button id="attemptQuizBtn" class="ms-3 mt-3 btn btn-primary">Attempt Quiz</button>
                                    </div>

                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quizPassword = "<?= $row['qui_password'] ?>"; 
            var enteredPassword = document.getElementById('qPassword');
            var attemptQuizBtn = document.getElementById('attemptQuizBtn');
            var quizPasswordContainer = document.getElementById('quizPasswordContainer');

            <?php
            $studentId = $_SESSION['userid'];
            $attendanceCheckSql = "SELECT attended FROM student_attempted_quiz WHERE stud_id = '$studentId' AND qui_id = $quizId";
            $attendanceResult = mysqli_query($conn, $attendanceCheckSql);
            $attendanceRow = mysqli_fetch_assoc($attendanceResult);
            ?>

            var attendedStatus = <?php echo $attendanceRow['attended']; ?>;

            if (attendedStatus === 0) {
    
                attemptQuizBtn.style.display = 'block';
                quizPasswordContainer.style.display = 'block';
            } else if (attendedStatus === 1) {
         
                attemptQuizBtn.style.display = 'none';
                quizPasswordContainer.style.display = 'none';
                var goToResultBtn = document.createElement('button');
                goToResultBtn.className = 'btn btn-primary';
                goToResultBtn.innerText = 'Go to Result';
                goToResultBtn.onclick = function() {
                    window.location.href = './quiz_result.php?quizId=<?= $quizId ?>';
                };
                document.querySelector('.text-center').appendChild(goToResultBtn);
            }

            attemptQuizBtn.addEventListener('click', function() {
                var enteredValue = enteredPassword.value;
                if (enteredValue === quizPassword) {
                    window.location.href = './attempt_quiz.php?quizId=<?= $quizId ?>';
                } else {
                    alert('Password is incorrect. Please try again.');
                }
            });
        });
    </script>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTab"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <script src="assets/js/main.js"></script>


</body>

</html>