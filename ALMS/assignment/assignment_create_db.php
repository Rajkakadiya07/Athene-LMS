<?php
session_start();
require_once "../connection.php";
require_once "../validation/PHP/form_validation.php";
extract($_POST);
$cseId = $_SESSION['course']['cse_id'];

date_default_timezone_set('Asia/Kolkata');

// echo "$name, $description, $startDate, $endDate, $totMarks<br>";

$dt1 = new DateTime($startDate);
$dt2 = new DateTime($endDate);

$sd= $dt1->format('Y-m-d H:i:s');
$ed= $dt2->format('Y-m-d H:i:s');

// echo "$sd, $ed<br>";

// print_r($_FILES);
// echo "<br>";


if(!empty($_FILES['attachment']['name'])){
    $dir = "../assignment/uploaded_files";
    if (!is_dir($dir)) {
        mkdir($dir);
    }
    $file = $_FILES['attachment']['tmp_name'];
    $filepath = "../assignment/uploaded_files/" . $_FILES['attachment']['name'];
    move_uploaded_file($file, $filepath);
    $sql = "INSERT INTO assignment (agn_name, agn_desc, agn_total_marks, agn_file, agn_start_date, agn_end_date, cse_id) values ('$name', '$description', '$totMarks', '$filepath', '$sd', '$ed', $cseId)";
}else{
    $sql = "INSERT INTO assignment (agn_name, agn_desc, agn_total_marks, agn_start_date, agn_end_date, cse_id) values ('$name', '$description', '$totMarks', '$sd', '$ed', $cseId)";
}
$id = null;
if(mysqli_query($conn, $sql)){
    $id = $conn->insert_id;
}else{
    echo mysqli_error($conn);
}

if(!empty($id)){
    $studQuery = "SELECT student.stud_id FROM student, course_student, course WHERE course.cse_id = course_student.cse_id AND student.stud_id = course_student.stud_id AND course.cse_id = $cseId";
    
    if($result = mysqli_query($conn, $studQuery)){
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()){
                $submissionQuery = "INSERT INTO assignment_submission (agn_id, stud_id) VALUES ($id, {$row['stud_id']})";
                if(mysqli_query($conn, $submissionQuery)){
                    echo "Inserted $id, {$row['stud_id']}<br>";
                }else{
                    echo mysqli_error($conn);
                    echo "<br>";
                }
            }
        }else{
            echo "No student found";
            echo "<br>";
        }
    }else{
        echo "No students found";
        echo mysqli_error($conn);
        echo "<br>";
    }
}


header("location:{$_SERVER['HTTP_REFERER']}");
