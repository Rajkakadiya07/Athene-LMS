<?php
session_start();
require_once('../connection.php');

if(isset($_POST['userids'])){
    $users = $_POST['userids'];
}
if(isset($_POST['useridt'])){
    $users = $_POST['useridt'];
}


$userid = null;
$email = null;
$i=0;
foreach($users as $user){
    $sql = "select usr_email from pending_requests where usr_id = '{$user}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $oneEmail[$i++] = $row['usr_email'];

    echo ($i-1)." => ".$oneEmail[$i-1];
}


foreach($users as $userid){
    
    if(isset($_POST['approveAllStudents'])){
        $sql = "INSERT INTO student SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, 1, usr_password, false FROM pending_requests WHERE usr_id = '{$userid}'";
    }
    if(isset($_POST['rejectAllStudents'])){
        $sql = "DELETE FROM pending_requests where usr_id ='{$userid}'";
    }
    if(isset($_POST['approveAllTeachers'])){
        $sql = "INSERT INTO teacher SELECT usr_id, usr_name, usr_contact_no ,usr_gender, usr_email, usr_password, false FROM pending_requests WHERE usr_id = '{$userid}'";
    }
    if(isset($_POST['rejectAllTeachers'])){
        $sql = "DELETE FROM pending_requests where usr_id ='{$userid}'";
    }

    if(mysqli_query($conn, $sql)){
        $sql = "DELETE FROM pending_requests where usr_id ='{$userid}'";
        if(mysqli_query($conn, $sql)){

        }else{
            mysqli_query($conn, $sql);
        }
        if(!empty($_POST['approveAllStudents'])){
            $catCode = substr($userid, 4, 8);
            $coursesOfCatQuery = "SELECT cse_id FROM category, course WHERE category.cat_id = course.cat_id AND cat_code = {$catCode}";
            
            if($courses = mysqli_query($conn, $coursesOfCatQuery)){
                if($courses->num_rows > 0){
                    while($course = $courses->fetch_assoc()){
                        $courseStudentQuery = "insert into course_student values ({$course['cse_id']}, '$userid')";
                        if(mysqli_query($conn, $courseStudentQuery)){
                            echo "Added to course {$course['cse_id']}, $userid<br>";
                        }else{
                            echo "Not addded to course {$course['cse_id']}, $userid<br>";
                        }
                    }
                }else{

                }
            }
        }
    }else {
        echo "$userid is not registered". mysqli_error($conn)."\n";
    }
}



function sendMail($userid, $email){

}


header("location:{$_SERVER['HTTP_REFERER']}");
?>