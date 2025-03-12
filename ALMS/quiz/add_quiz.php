<?php
session_start();
require_once "../connection.php";

if (isset($_POST['submit'])) {
    // Assuming you have sanitized the input values to prevent SQL injection
    $quizName = mysqli_real_escape_string($conn, $_POST['qName']);
    $quizDesc = mysqli_real_escape_string($conn, $_POST['qDesc']);
    $quizPass = mysqli_real_escape_string($conn, $_POST['qPass']);
    $startTime = date('Y-m-d H:i:s', strtotime($_POST['sTime'])); // Format start time
    $endTime = date('Y-m-d H:i:s', strtotime($_POST['eTime'])); // Format end time
    $totalMarks = 0;

    $cseid = $_SESSION['course']['cse_id'];
   
    $studentIds = array();

    // INSERT the quiz data
    // $sql = "INSERT INTO quiz (qui_name, qui_desc, qui_total_marks, qui_start_time, qui_end_time, cse_id) 
    //         VALUES ('$quizName', '$quizDesc', '$totalMarks', '$startTime', '$endTime', '$cseid')";

    // Assuming $quizPassword contains the password value you want to insert
$sql = "INSERT INTO quiz (qui_name, qui_desc, qui_total_marks, qui_start_time, qui_end_time, qui_password, cse_id) 
VALUES ('$quizName', '$quizDesc', '$totalMarks', '$startTime', '$endTime', '$quizPass', '$cseid')";


    if (mysqli_query($conn, $sql)) {
        $quizId = mysqli_insert_id($conn);
        $_SESSION['quiz_id'] = $quizId;
        echo "Quiz created successfully";
        echo $endTime;
    } else {
        echo "Error: " . mysqli_error($conn); // Add this line to display the error
    }
    
    // No need to close the connection here

    $enrollmentQuery = "SELECT stud_id FROM course_student WHERE cse_id = '$cseid'";
    $enrollmentResult = mysqli_query($conn, $enrollmentQuery);

    while ($enrollmentRow = mysqli_fetch_assoc($enrollmentResult)) {
        $studentIds[] = $enrollmentRow['stud_id'];
    }

    if (empty($studentIds)) {
        echo "No students enrolled in this course.";
       
    } else {
      
        $quizId = $_SESSION['quiz_id'];

      
        foreach ($studentIds as $studentId) {
            $insertStatement = "INSERT INTO student_attempted_quiz (qui_id, cse_id, stud_id) VALUES ('$quizId', '$cseid', '$studentId')";
            if (mysqli_query($conn, $insertStatement)) {
                // Insert successful
            } else {
                echo "Error inserting record for student $studentId: " . mysqli_error($conn);
                // Handle the error if needed.
            }
        }
    }

    // Finally, close the connection after all queries are executed
    mysqli_close($conn);
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}