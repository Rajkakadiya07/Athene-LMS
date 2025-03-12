<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;

        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        #calendar {
             
                overflow-y: auto;
              
            }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        /* Common styles for all screen sizes */

        /* ... your existing styles ... */

        /* Media query for smaller screens */
        @media (max-width: 767px) {

            html,
            body {
                font-size: 14px;
                /* Adjust the font size for smaller screens */
            }

            .card {
                margin-bottom: 20px;
                /* Add some space between cards on smaller screens */
            }

            /* Contain calendar within card on smaller screens */
          
           
            #calendar {
        margin-top: 20px; /* Add margin between calendar and event card on smaller screens */
        max-height: 300px; /* Adjust the maximum height of the calendar container if necessary */
        overflow-y: auto; /* Add vertical scrollbar if necessary */
    }

    .event-card {
        margin-top: 20px; /* Add margin above the event card on smaller screens */
        margin-bottom: 20px; /* Add margin below the event card on smaller screens */
    }
  /* Media query for smaller screens */
@media (max-width: 767px) {
    /* ... your existing styles ... */

    .fc .fc-header-toolbar .fc-prev-button,
    .fc .fc-header-toolbar .fc-next-button,
    .fc .fc-header-toolbar .fc-today-button,
    .fc .fc-header-toolbar .fc-month-button,
    .fc .fc-header-toolbar .fc-agendaWeek-button,
    .fc .fc-header-toolbar .fc-agendaDay-button {
        font-size: 16px; /* Adjust button font size */
        width: 50px; /* Set a wider width for the "Today" button */
        height: 40px; /* Set a fixed height for the buttons */
        text-align: center; /* Center the text inside the button */
        line-height: 40px; /* Center the icon vertically */
        padding: 0; /* Remove padding to ensure fixed dimensions */
        margin-right: 10px;
        /* Add margin between buttons */
    }

    /* Flex container for navigation buttons */
    .fc .fc-header-toolbar {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    /* Adjust the today button text */
    .fc-today-button {
        white-space: nowrap; /* Prevent button text from wrapping */
    }
        }}

        /* Media query for medium-sized screens */
        @media (min-width: 768px) and (max-width: 991px) {

            html,
            body {
                font-size: 16px;
                /* Adjust the font size for medium-sized screens */
            }
        }

        /* Media query for larger screens */
        @media (min-width: 992px) {

            html,
            body {
                font-size: 18px;
                /* Adjust the font size for larger screens */
            }
        }
        
    </style>
</head>


<body>
    <?php

    require_once "../connection.php";
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <main id="main" class="main ps-0 text-dark">
        <div class='card  ms-3'>
            <div class="card-body">

                <div class="container py-5" id="page-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <div id="calendar"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <?php
                            if ($_SESSION['usertype'] != "Student") {
                            ?>
                                <div class="card event-card">
                                    <h5 class="ms-3 mt-2 card-title">Add event</h5>
                                    <div class="card-body">
                                        <div class="container-fluid ">
                                            <form action="save_schedule.php" method="post" id="schedule-form">
                                                <input type="hidden" name="id" value="">
                                                <div class="form-group mb-2">
                                                    <label for="title" class="control-label mt-2">Title</label>
                                                    <input type="text" class="form-control form-control-sm" name="title" id="title" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="description" class="control-label">Description</label>
                                                    <textarea rows="3" class="form-control form-control-sm" name="description" id="description" required></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="start_datetime" class="control-label">Start</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" name="start_datetime" id="start_datetime" required>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="end_datetime" class="control-label">End</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" name="end_datetime" id="end_datetime" required>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-sm" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                            <button class="btn btn-default border btn-sm" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="card">
                                <div class="card-body mt-3">
                                    <h5 class="ms-3 card-title">Activities</h5>
                                    <div class="container-fluid mt-2">
                                        <?php
                                        if ($_SESSION['usertype'] == "Admin") {
                                            $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment union select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material union SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
                                            BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "'  limit 30";
                                        } else if ($_SESSION['usertype'] == "Teacher") {
                                            $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as 
                                            start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment, course_teacher where 
                                            assignment.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}'                                        
                                            union
                                             select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material,
                                              course_teacher where learning_material.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}'
                                              union
                                               SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
                                               BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "'  limit 30";
                                        } else if ($_SESSION['usertype'] == "Student") {
                                            $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as 
                                            start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment, course_student where 
                                            assignment.cse_id = course_student.cse_id and stud_id = '{$_SESSION['userid']}'                                        
                                            union
                                             select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material,
                                              course_student where learning_material.cse_id = course_student.cse_id and stud_id = '{$_SESSION['userid']}'
                                              union
                                               SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
                                             BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "'  limit 30";
                                        }

                                        if ($result = mysqli_query($conn, $sql)) {


                                            if (mysqli_num_rows($result) > 0) {
                                                // OUTPUT DATA OF EACH ROW
                                                echo "<ol>";
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    if ($row['activity'] == "assignment") {
                                                        echo "<a href='../assignment/view_assignment.php?agnId=$row[id]'><li>" . $row["title"] . "</li></a>";
                                                    } else if ($row['activity'] == "LM") {
                                                        echo "<a href='../learning_material/view_materials.php?materialId=$row[id]'><li>" . $row["title"] . "</li></a>";
                                                    }
                                                }
                                                echo "</ol>";
                                            } else {
                                                echo "No events found";
                                            }
                                        }
                                        // if (mysqli_num_rows($resul) > 0) {
                                        //     // OUTPUT DATA OF EACH ROW
                                        //     while ($row = mysqli_fetch_assoc($resul)) {
                                        //         echo  $row["agn_name"] . "<br><br>";
                                        //     }
                                        // }


                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Event Details Modal -->
    <div class="text-dark modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered" id="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <?php

    if ($_SESSION['usertype'] == "Admin") {
        $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as start_datetime, agn_end_date as end_datetime, 
        'assignment' as activity from assignment 
        union select lm_id as id, lm_name as title, 
        lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material 
        union SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) 
        as combine_table where start_datetime 
        BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "' limit 30";
    } else if ($_SESSION['usertype'] == "Teacher") {
        $sql = "
        SELECT id, title, start_datetime, end_datetime, activity FROM 
        ( select agn_id as id, agn_name as title, agn_start_date as start_datetime, agn_end_date as end_datetime, 'assignment' as activity from 
        assignment, course_teacher where assignment.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}' 
        union select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from 
        learning_material, course_teacher where learning_material.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}' 
        union SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) 
        as combine_table where start_datetime BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "' limit 30;
        ";
    } else if ($_SESSION['usertype'] == "Student") {
        $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as 
    start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment, course_student where 
    assignment.cse_id = course_student.cse_id and stud_id = {$_SESSION['userid']}                                        
    union
     select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material,
      course_student where learning_material.cse_id = course_student.cse_id and stud_id = {$_SESSION['userid']}
      union
       SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
        BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "' limit 30";
    }

    if ($schedules = $conn->query($sql)) {
        $sched_res = [];
        foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
            $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
            $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
            $sched_res[$row['id']] = $row;
        }
    }
    if (isset($conn))
        $conn->close();
    ?>
</body>

<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="../validation/js/form_validation.js"></script>
<script src="./js/script.js"></script>

<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')

    // $('#schedule-form').on('submit', function(e) {
    //     e.preventDefault();
    //     var start = document.getElementById('start_datetime').value;
    //     var end = document.getElementById('end_datetime').value;
    //     stdate = new Date(start);
    //     eddate = new Date(end);

    // if (eddate < stdate && etdate != stdate) {
    //     alert('Start date is greater than the end date.');
    //     return false;
    // }
    //     return true;
    // });
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            // ... other calendar options
            aspectRatio: 1.8, // Adjust this value according to your design
            contentHeight: 'auto', // Automatically adjusts the height based on content
            // ... other options
        });
    });
</script>
<?php require_once "../js.php" ?>

</html>