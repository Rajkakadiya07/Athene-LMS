<?php 
require_once 'check-login.php';
$error_message = "";
$success_message = "";

date_default_timezone_set("Asia/Kolkata");

function generateRoomCode($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $roomCode = '';

    for ($i = 0; $i < $length; $i++) {
        $roomCode .= $characters[rand(0, $charactersLength - 1)];
    }

    return $roomCode;
}

if (isset($_POST["addConferences"])) {

    require_once 'common-functions.php';
    // check boolean variable
    $check = true;
    $error_message = '';

    $topic_id = htmlspecialchars(base64_decode(trim($_GET["id"])));
    $teacher_id = trim($_SESSION["logged_user_id_teacher"]);
    $room_name = htmlspecialchars(trim($_POST["conferenceTitle"]));
    $room_startdatetime = trim($_POST["startTime"]);
    $room_enddatetime = trim($_POST["endTime"]);
    $room_code = generateRoomCode();

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    doDBConnection();
    
    $sql = "INSERT INTO conferences(topic_id,teacher_id,room_name,description,room_code,start_time,end_time) VALUES(?,?,?,?,?,?,?);";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("iisssss",$topic_id,$teacher_id,$room_name,$room_description,$room_code,$room_startdatetime,$room_enddatetime);
        $stmt->execute();
        $resource_id = $stmt->insert_id;
        $success_message = "Conference added successfully.";
        $stmt->close();
    } else {
        $error_message = 'Could not add conference.';
    }

    closeDBConnection();   
    unset($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Conferences</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/other-styles.css">

    <!-- rich text editor -->
    <link href="../assets/vendors/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendors/quill/quill.bubble.css" rel="stylesheet">


    <!-- <link rel="stylesheet" href="styleDashboard2.css"> -->
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/logo-1.png" />
    <style>
        @media only screen and (min-width: 600px) {
            .subject-name-title {
                font-size: 30px !important;
            }
        }

        p {
            font-size: 14px;
        }

        .err-msg {
            font-size: 14px;
        }

        .auto-generate-button {
            cursor: pointer;
        }

        .info-icons {
            cursor: pointer;
        }

        .info-content {
            display: none;
            position: absolute;
            width: 200px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
        }

        .info-icons:hover .info-content {
            display: block;
        }

        .file-info-cont {
            font-size: 12px;
            display: flex;
            justify-content: end;
            margin-top: 5px;
        }

        @media only screen and (max-width: 600px) {
            .card-body {
                padding: 20px !important;
            }

            .content-wrapper {
                padding: 20px !important;
            }

            .page-title {
                font-size: 14px;
            }

            .breadcrumb-item {
                font-size: 11px !important;
            }

            .btn {
                padding: 10px !important;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div id="loader-6" class="loader-screen-email">
        <img src="../assets/images/loader.gif" alt="Loader">
    </div>
    <div class="container-scroller">
        <!-- header -->
        <?php require_once 'header.php'; ?>
        <div class="container-fluid page-body-wrapper">
            <?php
            include_once('sidebar-teacher.php');
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Conferences </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="subject-info.php?sid=<?php echo $_GET["id"];?>">Conference</a></li>
								<li class="breadcrumb-item active" aria-current="page"><a href="add-conference.php?id=<?php echo $_GET["id"];?>">Add Conference</a></li>
							</ol>
                        </nav>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-danger">
                                        <?php echo $error_message; ?>    
                                    </p>

                                    <p class="text-success">
                                        <?php echo $success_message; ?>    
                                    </p>

                                    <h4 class="card-title">Conference Details</h4>

                                    <!-- <p class="card-description">  </p> -->
                                    <form class="pt-3" action="" name="conferenceForm" method="POST">
                                        <div class="form-group">
                                            <label for="">Conference title</label>
                                            <input type="text" class="form-control" id="conferenceTitle" name="conferenceTitle"
                                                placeholder="Title">
                                            <span class="text-danger err-msg" id="error-message-1"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Start Time</label>
                                            <input type="datetime-local" class="form-control" id="startTime" name="startTime" min="<?php echo date('Y-m-d H:i');?>"/>
                                            <span class="text-danger err-msg" id="error-message-2"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">End Time</label>
                                            <input type="datetime-local" class="form-control" id="endTime" name="endTime" min="<?php echo date('Y-m-d H:i');?>"/>
                                            <span class="text-danger err-msg" id="error-message-3"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <section class="section">
                                                <!-- Quill Editor Default -->
                                                <div class="quill-editor-full" id="quill-editor"
                                                    style="min-height: 100px;">

                                                </div>
                                                <textarea id="quillContent" name="quillContent"
                                                    style="display:none;"></textarea>
                                            </section>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary me-2" name="addConferences"
                                            value="Submit">Save</button>
                                        <button class="btn btn-gradient-light" type="reset" id="cancel-btn">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include_once('../admin/footer.php');
                ?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- <script src="../assets/js/resourceAssignValid.js"></script> -->

    <!-- quill editor -->
    <script src="../assets/vendors/quill/quill.min.js"></script>
    <script src="../assets/js/main.js"></script>


    <!-- End custom js for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#loader-6").hide();
            $("input, textarea").focus(function () {
                $(".err-msg").text("");
            });


            $('form[name="conferenceForm"]').submit(function(event) {
                var isValid = true;
                var value = $('.ql-editor').html();

                // validate to see if it contains empty string
                if (value == "<p><br></p>") {
                    value = "";
                } 

                $("#quillContent").val(value);

                // Validate conference title
                var conferenceTitle = $('#conferenceTitle').val().trim();
                if (conferenceTitle === '') {
                    $('#error-message-1').text('Conference title is required');
                    isValid = false;
                } else if (conferenceTitle.length > 100) {
                    $('#error-message-1').text('Conference title must be at most 100 characters');
                    isValid = false;
                } else if (!/^[a-zA-Z0-9\s()\[\]{}\-]+$/.test(conferenceTitle)) {
                    $('#error-message-1').text('Conference title can only contain alphabets, numbers, brackets, hyphen, and spaces');
                    isValid = false;
                } else {
                    $('#error-message-1').text('');
                }

                // Validate start time
                var startTime = new Date($('#startTime').val().trim());
                if (isNaN(startTime)) {
                    $('#error-message-2').text('Invalid start time');
                    isValid = false;
                } else {
                    $('#error-message-2').text('');
                }

                // Validate end time
                var endTime = new Date($('#endTime').val().trim());
                if (isNaN(endTime)) {
                    $('#error-message-3').text('Invalid end time');
                    isValid = false;
                } else {
                    $('#error-message-3').text('');
                }

                // Validate time difference
                var timeDifference = (endTime - startTime) / (1000 * 60); 
                if (timeDifference < 2) {
                    $('#error-message-3').text('There must be at least 2 minutes difference between start and end time');
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });

    </script>
</body>
</html>