<?php 
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
    </style>
    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body>
    <?php
    require_once "../connection.php";
    
        require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <main id="main" class="main ps-0 text-dark">
        <div class='card'>
            <div class="card-body">

                <div class="container py-5" id="page-container">
                    <div class="row mb-2">
                        <div class='col-12 d-flex flex-row-reverse'>
                            <button class="btn btn-primary" id="add">Add event</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="calendar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Event Details Modal -->
    <div class="text-dark modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
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
                <div class="modal-footer ">
                    <div class="text-end">
                        <!-- <button type="button" class="btn btn-primary btn-sm " id="edit" data-id="">Edit</button> -->
                        <button type="button" class="btn btn-danger btn-sm " id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm " data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <!-- Event Details Modal -->
    <form action="save_schedule.php" method="post" id="schedule-form">
        <div class="text-dark modal fade" tabindex="-1" data-bs-backdrop="static" id="mod">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h5 class="modal-title">Add event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="cardt  ">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <input type="hidden" name="id" value="">
                                    <div class="form-group mb-2">
                                        <label for="title" class="control-label">Title</label>
                                        <input type="text" class="form-control form-control-sm " name="title" id="title" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="description" class="control-label">Description</label>
                                        <textarea rows="3" class="form-control form-control-sm " name="description" id="description" required></textarea>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="start_datetime" class="control-label">Start</label>
                                        <input type="datetime-local" class="form-control form-control-sm " name="start_datetime" id="start_datetime" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="end_datetime" class="control-label">End</label>
                                        <input type="datetime-local" class="form-control form-control-sm " name="end_datetime" id="end_datetime" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <div class="text-end">
                            <button class="btn btn-primary btn-sm " type="submit" form="schedule-form"><i class="fa fa-save me-2"></i>Save</button>
                            <button class="btn btn-default border btn-sm " data-bs-dismiss="modal" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Event Details Modal -->

    <?php
    $schedules = $conn->query("SELECT id, title, start_datetime, end_datetime FROM ( select agn_id as id, agn_name as title, agn_start_date as start_datetime, agn_end_date as end_datetime from assignment union select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null from learning_material  union SELECT id, title, start_datetime, end_datetime FROM schedule_list) as combine_table limit 100;");
    $sched_res = [];
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[$row['id']] = $row;
    }
    ?>
    <?php
    if (isset($conn)) $conn->close();
    ?>
</body>

<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
    $(document).ready(function() {
        $('#add').click(function() {
            $('#mod').modal('show');
        });
    });
</script>
<script src="./js/script.js"></script>

</html>