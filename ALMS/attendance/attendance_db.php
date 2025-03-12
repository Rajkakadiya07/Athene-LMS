<?php
require_once "../connection.php";
extract($_POST);

if (empty($course)) {
    echo "course id not found";
} else if (empty($date)) {
    echo "date not found";
} else if (empty($time)) {
    echo "time not found";
} else if (empty($allstuds)) {
    echo "students' data not found";
} else {
    if (!empty($absentStuds)) {
        $presentStuds = array_diff($allstuds, $absentStuds);
    } else {
        $presentStuds = $allstuds;
    }
    foreach ($presentStuds as $stud) {
        $sql = "INSERT INTO attendance values ($course, '$date', '$time', 1, '$stud')";
        if (mysqli_query($conn, $sql)) {
            echo "inserted $sql<br>";
        } else {
            echo mysqli_error($conn);
        }
    }
    if (!empty($absentStuds)) {
        foreach ($absentStuds as $stud) {
            $sql = "INSERT INTO attendance values ($course, '$date', '$time', 0, '$stud')";
            if (mysqli_query($conn, $sql)) {
                echo "inserted $sql<br>";
            } else {
                echo mysqli_error($conn);
            }
        }
    }
    header("location:attendance.php");
    
}
