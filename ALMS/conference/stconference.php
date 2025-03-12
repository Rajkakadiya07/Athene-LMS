<?php require_once 'check-login.php'; 
require_once 'common-functions.php';
include_once 'user-info-student.php';

date_default_timezone_set("Asia/Kolkata");
$conference_id = 0;
$student_id = $_SESSION["logged_user_id_student"];

if (isset($_GET["id"])) {
    $conference_id = htmlspecialchars(base64_decode(trim($_GET["id"])));
}

if ($conference_id == 0) {
    echo 'Something went wrong...';
    die;
}

// fetching conference data 
doDBConnection();

$conference_data = array();
$conference_data = getConferenceDetails($conference_id);

if (empty($conference_data)) {
    echo 'Something went wrong...';
    die;
}

$room_code = $conference_data["room_code"];
$check_status = true;

// first check if data is not inserted
$sql = "SELECT COUNT(*) AS count FROM conference_participants WHERE conference_id = ? AND student_id = ?;";
if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("ii",$conference_id,$student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $conference_data = $result->fetch_assoc();
        if ($conference_data["count"] == 1) {
            $check_status = false;
        }
        unset($conference_data);
    }

    $result->free();
    $stmt->close();
}

// insert data in pariticipant table if not inserted
$sql = "REPLACE INTO conference_participants(conference_id,student_id,join_time) VALUES(?,?,?);";

if ($check_status) {
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("iis",$conference_id,$student_id,$join_date);
        $join_date = date("Y-m-d H:m:s");
        $stmt->execute();
        $stmt->close();
    }
}


// fetching batch sem id
$batch_sem_id = 0;
$batch_sem_id = getBatchSemesterIdFromConferenceId($conference_id);

closeDBConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Video Conference</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/other-styles.css">
    <!-- <link rel="stylesheet" href="styleDashboard2.css"> -->
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/logo-1.png" />
    <script src="https://meet.jit.si/external_api.js"></script>
    <style>
        #jitsi-container {
            width: 100%;
        }

        #jitsi-container iframe {
            width: 100%;
            height: 100vh;
        }

        @media only screen and (max-width: 600px) {
            #jitsiConferenceFrame0 {
                width: 90vw !important;
            }

            #jitsiConferenceFrame0 {
                height: 550px !important;
            }

            .class-main-container {
                padding: 0px !important;
            }

            .card-body {
                padding: 3px !important;
            }
        }

        @media screen and (min-width: 900px) and (max-width: 1400px) {
            #jitsiConferenceFrame0 {
                width: 65vw !important;
            }
        }

        #jitsiConferenceFrame0 {
            border-radius: 10px;
        }

        .loader-screen-conference {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader-screen-conference img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <div id="loader-6" class="loader-screen-conference">
        <img src="../assets/images/loader.gif" alt="Loader">
    </div>
    <div class="container-scroller">
        <?php require_once 'header.php'; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php require_once 'sidebar-student.php'; ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-12 class-main-container">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="col-md-6">
                                        <div id="meet"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button class="btn btn-primary" id="end-conference-btn">Finish</button>
                        </div>
                    </div>
                </div>
                <!-- footer -->
                <?php require_once '../admin/footer.php'; ?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../assets/js/notifications.js"></script>
    <script>

        setTimeout(function () {
            $('#loader-6').css("display", "none");
        }, 3000);

        $(document).ready(function() {
            const domain = 'meet.jit.si';
            const options = {
                roomName: '<?php echo $room_code; ?>',
                width: '75vw',
                height: 600,
                parentNode: document.getElementById('meet'),
                configOverwrite: {
                    prejoinPageEnabled: false
                },
                interfaceConfigOverwrite: {
                    SHOW_WATERMARK_FOR_GUESTS: false
                },
                userInfo: {
                    displayName: '<?php echo $student_name;?>'
                },
                onload: () => {
                    // Handle screen sharing button click event
                    $('#start-screen-sharing').click(() => {
                        api.executeCommand('toggleShareScreen');
                    });
                }
            };

            const api = new JitsiMeetExternalAPI(domain, options);


            // notification and other related chats
            getNotifications(<?php echo $_SESSION["logged_user_id_student"]; ?>);
            getChats();
        });


        $("#end-conference-btn").click(function() {
            $.ajax({
				url: "insert-conference.php",
				type: "POST",
				data: {
                    endedMeeting: "Ended",
                    conferenceId: <?php echo $conference_id;?>,
                    studentId: <?php echo $student_id; ?>
				},
				beforeSend: function() {
					$("#loader-6").css("display","flex");
				},
				success: null,
				complete: function() {
					$("#loader-6").css("display","none");
                    window.location.replace("subject.php?id=<?php echo base64_encode($batch_sem_id);?>");
                    window.history.replaceState({}, "", "subject.php?id=<?php echo base64_encode($batch_sem_id);?>");
				}
			});
        });
    </script>
</body>

</html>