<style>
    
/* Media query for phones */



</style>
<?php


$submissionQuery = "SELECT count(*) as studs from assignment_submission WHERE agn_id = {$_SESSION['assignment']['agn_id']}";
$assignmentQuery = "SELECT * FROM assignment WHERE agn_id = {$_SESSION['assignment']['agn_id']}";
$submittedQuery = "SELECT count(*) as totalSubmitted from assignment_submission WHERE agn_id = {$_SESSION['assignment']['agn_id']} and agn_submission_status <> 0";
$gradedQuery = "SELECT count(*) as graded from assignment_submission WHERE agn_id = {$_SESSION['assignment']['agn_id']} and agn_submission_status = true and agn_obtained_marks is not null";


if ($submissions = mysqli_query($conn, $submissionQuery)) {
    if ($submissions->num_rows > 0) {
        $submissions = $submissions->fetch_assoc();
    } else {
    }
}

if ($submitted = mysqli_query($conn, $submittedQuery)) {
    if ($submitted->num_rows > 0) {
        $submitted = $submitted->fetch_assoc();
    }
}
if ($graded = mysqli_query($conn, $gradedQuery)) {
    if ($graded->num_rows > 0) {
        $graded = $graded->fetch_assoc();
    }
}

$end = null;
$start = "now";

if ($assignment = mysqli_query($conn, $assignmentQuery)) {
    if ($assignment->num_rows > 0) {
        $assignment = $assignment->fetch_assoc();
        $end = $assignment['agn_end_date'];
    } else {
        $end = "now";
    }
}


$totalStudCount = $submissions['studs'] ?? 0;
$submittedStudCount = $submitted['totalSubmitted']  ?? 0;
$remainingSubmissionsCount = $submissions['studs'] - $submitted['totalSubmitted'] ?? 0;
$gradedStuds = $graded['graded'] ?? 0;
$needsGrading = $submitted['totalSubmitted'] - $graded['graded'] ?? 0;

date_default_timezone_set('Asia/Kolkata');

$start_date = strtotime(date("Y-m-d h:i:s A"));
$end_date = strtotime($end);    

// Calculate the interval in seconds
$interval = $end_date - $start_date;

// Convert the interval to days, hours, minutes, and seconds
$days = floor($interval / (60 * 60 * 24));
$hours = floor(($interval - ($days * 60 * 60 * 24)) / (60 * 60));
$minutes = floor(($interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
$seconds = $interval - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60);

// Print the interval
if($days < 0 || $hours == 0 && $minutes == 0 && $seconds == 0){
    $timeRemain = "<span class='text-danger'> Deadline over </span>";
}else{
    $timeRemain = ($days != 0) ? $days . " days " : ""; 
    $timeRemain .= $hours . ' hours ' . $minutes . ' minutes ' . $seconds . ' seconds';
}
?>
<style>
/* Custom CSS for responsiveness */
@media (max-width: 767px) {
    .custom-card {
        margin: 0;
        width: 92%;
    }
}
</style>
<div class='card ms-4 col-11 custom-card'>
    <div class='card-body'>
        <div class='card-title'>Summary</div>
        <div class='table-responsive'>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Total students</th>
                        <th scope='col'>Submitted</th>
                        <th scope='col'>Remaining submissions</th>
                        <th scope='col'>Graded</th>
                        <th scope='col'>Needs grading</th>
                        <th scope='col'>Time remaining</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $totalStudCount; ?></td>
                        <td><?php echo $submittedStudCount; ?></td>
                        <td><?php echo $remainingSubmissionsCount; ?></td>
                        <td><?php echo $gradedStuds; ?></td>
                        <td><?php echo $needsGrading; ?></td>
                        <td><?php echo $timeRemain; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='text-center'>
            <?php
            echo "<a href='view_submissions.php' class='btn btn-success'>View submissions</a>";
            ?>
        </div>
    </div>
</div>
