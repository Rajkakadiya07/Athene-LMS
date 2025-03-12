<style>
    .table-container {
        height: 400px;
        overflow-y: auto;
    }

    .fixed-header {
        position: sticky;
        top: 0;
        background-color: #1d1d1d;
        z-index: 1;
    }

    .table-wrapper {
        width: 100%; /* Change to full width for small screens */
        float: none; /* Clear float for small screens */
        margin-right: 0; /* Remove right margin for small screens */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    th,
    td {
        text-align: center;
        padding: 8px;
    }

    @media screen and (min-width: 768px) {
        .table-wrapper {
            width: 48%; /* Restore original width for larger screens */
            float: left;
            margin-right: 5px;
        }
    }
</style>

<?php
require_once "../connection.php";
$students = "
<div style='height: 450px; overflow-y: auto;'>
    <div class='table-wrapper'>
        <table style='width:100%;' class='table table-borderless '>
        <thead style='color:white;' class='fixed-header'>
        <tr>
            <th class='table-dark' scope='col'><input class='form-check-input' type='checkbox' id='selectalls'></th>
            <th class='table-dark' scope='col'>Enrollment No</th>
            <th class='table-dark' scope='col'>Name</th>
        </tr>
        </thead>";

$sql = "select student.stud_id, stud_name from course, course_student, student where course.cse_id = course_student.cse_id and course_student.stud_id = student.stud_id and course.cse_id = {$_POST['cseid']}";
$result = mysqli_query($conn, $sql);

if (!empty($result->num_rows) && $result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $totalStudents = count($rows);
    $halfStudents = ceil($totalStudents / 2);

    foreach (array_slice($rows, 0, $halfStudents) as $row) {
        $students .= "
        <tr>
            <th><input class='form-check-input studentid' type='checkbox' name='absentStuds[]' value='{$row['stud_id']}'><input type='hidden' name='allstuds[]' value='{$row['stud_id']}'></th>
            <th>{$row['stud_id']}</th>
            <td>{$row['stud_name']}</td>
        </tr>
        ";
    }

    $students .= "</table></div>";

    $students .= "
    <div class='table-wrapper'>
        <table style='width:100%;' class='table table-borderless '>
        <thead style='color:white;' class='fixed-header'>
        <tr>
            <th class='table-dark' scope='col'><input class='form-check-input' type='checkbox' id='selectalls'></th>
            <th class='table-dark' scope='col'>Enrollment No</th>
            <th class='table-dark' scope='col'>Name</th>
        </tr>
        </thead>";

    foreach (array_slice($rows, $halfStudents) as $row) {
        $students .= "
        <tr>
            <th><input class='form-check-input studentid' type='checkbox' name='absentStuds[]' value='{$row['stud_id']}'><input type='hidden' name='allstuds[]' value='{$row['stud_id']}'></th>
            <th>{$row['stud_id']}</th>
            <td>{$row['stud_name']}</td>
        </tr>
        ";
    }

    $students .= "</table></div>";

} else {
    $students = null;
}

echo $students;
?>
