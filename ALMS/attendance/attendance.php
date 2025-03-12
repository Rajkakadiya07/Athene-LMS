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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>

@media (max-width: 768px) {
            .card {
                margin: 10px 0;
            }
        }

        /* Media query for small screens (up to 767px) */
        @media (max-width: 767px) {
            .nav-tabs {
                flex-direction: column;
            }

            .nav-link {
                width: 100%;
                text-align: left;
            }

            .tab-pane {
                padding: 10px;
            }

            .box,
            .box-2 {
                width: 100%;
                margin: 0;
            }

            .options label,
            .options input {
                width: 100%;
            }
        }

        /* Media query for medium screens (768px to 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                flex: 1;
                text-align: center;
            }
        }

        /* Media query for large screens (992px and above) */
        @media (min-width: 992px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                /* Adjust the width based on your preference */
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .card-title {
                font-size: 1rem;
            }

            .place-card__content_header {
                margin-bottom: 0.5rem;
            }

            .card-icon {
                font-size: 40px;
            }

            .dropdown-menu {
                min-width: 150px;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once("../header.php");
    require_once("../sidebar.php");
    require("../connection.php");
    ?>


    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Attendance</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Take Attedance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Attendance Report</button>
                        </li>
                    </ul>
                </div>

                <!-- First Tab -->
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                        aria-labelledby="home-tab">
                        <form method="post" action="attendance_db.php">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <label class="ms-2 form-label text-dark">Category</label>
                                    <select id="inputCategory" name="category" class="form-select">
                                        <option value="" selected>Select</option>
                                        <?php
                                        $sql = "select * from category";
                                        $result = mysqli_query($conn, $sql);
                                        if (!empty($result->num_rows) && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='{$row['cat_id']}'>{$row['cat_full_name']} ({$row['cat_short_name']})</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="ms-2 form-label text-dark">Course</label>
                                    <select id="inputCourse" name="course" class="form-select">
                                        <option value="" selected>Select</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="ms-2 form-label text-dark">Date</label>
                                    <input type="date" id="inputDate" class="form-control" name="date">
                                </div>
                                <div class="col-md-2">
                                    <label class="ms-2 form-label text-dark">Time</label>
                                    <input type="time" id="inputTime" class="form-control" name="time">
                                </div>
                                <div class="col-md-2 mt-4">
                                    <button type="submit" name="tps" class="btn btn-success my-2">Submit</button>
                                </div>
                            </div>
                        </form>

                        <div class="row justify-content-center mt-4">
                            <div class="col-md-11">
                                <div class="ms-3" id="students"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form id="reportForm" method="POST" action="">
                            <div class="row justify-content-center ">
                                <div class="col-xl-8">

                                    <div class="row mb-3 mt-2">
                                        <label class="col-md-2 col-form-label text-dark">Report</label>
                                        <div class="col-md-10">
                                            <select id="report" name="reportType" class="form-select"
                                                onchange="document.getElementById('reportForm').setAttribute('action', this.value);">
                                                <option value="" selected>Select</option>
                                                <option value="new_report_monthly.php">Student attendance date wise
                                                </option>
                                                <option value="new_report_perc_wise.php">Student attendance absert
                                                    percentage wise</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 mt-2">
                                        <label class="col-md-2 col-form-label text-dark">Category</label>
                                        <div class="col-md-10">
                                            <select id="inputCategory1" name="reportCategory" class="form-select"
                                                onchange="document.getElementById('categoryName').setAttribute('value', this.selectedOptions[0].text);">
                                                <option selected>Select</option>
                                                <?php
                                                $sql = "select * from category";
                                                $result = mysqli_query($conn, $sql);
                                                if (!empty($result->num_rows) && $result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<option value='{$row['cat_id']}'>{$row['cat_full_name']} ({$row['cat_short_name']})</option>";
                                                    }
                                                }
                                                ?>

                                            </select>
                                            <input type="hidden" id="categoryName" name="categoryName" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark">Courses</label>
                                        <div class="col-md-10">
                                            <select id="inputCourse1" name="reportCourse" class="form-select"
                                                onchange="document.getElementById('courseName').setAttribute('value', this.selectedOptions[0].text);">
                                                <option value="" selected>Select</option>

                                            </select>
                                            <input type="hidden" id="courseName" name="courseName" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark">Start Date</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="sdate" name="reportStartDate">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-md-2 col-form-label text-dark">End Date</label>
                                        <div class="col-md-10">
                                            <input type="date" class="form-control" id="edate" name="reportEndDate">
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="excludeDiv">
                                        <label class="col-md-2 col-form-label text-dark">Exclude</label>
                                        <div class="col-md-10">
                                            <input class="form-check-input ms-1" type="checkbox" name="days[]"
                                                value="Sunday" id="sun" checked><label for="sun"
                                                class="text-dark ms-1 ">Sun</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Monday" id="Mon"> <label for="Mon"
                                                class="text-dark ms-1 ">Mon</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Tuesday" id="Tue"> <label for="Tue"
                                                class="text-dark ms-1 ">Tue</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Wednesday" id="Wed"> <label for="Wed"
                                                class="text-dark ms-1 ">Wed</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Thursday" id="Thur"> <label for="Thur"
                                                class="text-dark ms-1 ">Thur</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Friday" id="Fri"> <label for="Fri"
                                                class="text-dark ms-1 ">Fri</label>
                                            <input class="form-check-input ms-1 " type="checkbox" name="days[]"
                                                value="Saturday" id="Sat"> <label for="Sat"
                                                class="text-dark ms-1 ">Sat</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <input type="submit" name="sub" id="subm" class="btn btn-success "
                                                value="Generate Report">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End  Tab -->
        </div>
    </main>


    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script>
        $(document).ready(function () {

            $('#report').on('change', function () {
                var link = $('#report :selected').val();
                if (link == "attendance_report_monthly.php") {
                    $('#excludeDiv').hide();
                } else if (link == "absent_perc_wise_report.php") {
                    $('#excludeDiv').show();
                }
            });

            function todayDate() {
                let d = new Date();
                let currDate = d.getDate();
                let currMonth = d.getMonth() + 1;
                let currYear = d.getFullYear();
                today = currYear + "-" + ((currMonth < 10) ? '0' + currMonth : currMonth) + "-" + ((currDate < 10) ? '0' + currDate : currDate);
                return today
            }

            $(document).ready(function () {
                var now = new Date();
                var hh = now.getHours();
                var mm = now.getMinutes();
                if (mm < 10) {
                    mm = '0' + mm;
                }
                var timeString = hh + ':' + mm + ':' + '00';
                $('#inputTime').val(timeString);
            });

            $('#inputDate').val(todayDate());

            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();
                // category = document.getElementById('csecategory').value;
                // fullname = document.getElementById('csename').value;
                // desc = document.getElementById('csedesc').value;
                // startdate = document.getElementById('csestartdate').value;
                // enddate = document.getElementById('cseenddate').value;

                // if (fullname == "") {
                //     return false;
                // } else if (desc == "") {
                //     return false;
                // } else if (startdate == "") {
                //     return false;
                // } else if (enddate == "") {
                //     return false;
                // }

                form.submit();
            });

            $('#students').on('click', '#selectalls', function () {
                console.log("checked");
                if (this.checked) {
                    $('.studentid').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.studentid').each(function () {
                        this.checked = false;
                    });
                }
            });


            $('#inputCategory, #inputCategory1').on('change', function (e) {
                var select = e.target.id;
                var cid = $('#' + select + ' :selected').val();
                $.ajax({
                    url: "ajax_course.php",
                    method: "post",
                    data: {
                        id: cid
                    },
                    success: function (response) {
                        if (select == "inputCategory") {
                            document.getElementById('inputCourse').innerHTML = response;
                        } else {
                            document.getElementById('inputCourse1').innerHTML = response;
                        }
                    }
                });
            });


            $('#inputCourse').on('change', function () {
                var cid = $('#inputCourse :selected').val();
                $.ajax({
                    url: "ajax_student.php",
                    method: "post",
                    data: {
                        cseid: cid
                    },
                    success: function (response) {
                        document.getElementById('students').innerHTML = response;
                    }
                });
            });

            $('#inputCourse1').on('change', function () {
                var cid = $('#inputCourse1 :selected').val();
                $.ajax({
                    url: "ajax_date.php",
                    method: "post",
                    data: {
                        cseid: cid
                    },
                    success: function (response) {
                        dates = JSON.parse(response);
                        if (dates.start != null) {
                            $('#sdate').val(dates.start);
                        }
                        if (dates.end != null) {
                            $('#edate').val(dates.end);
                        }
                    }
                });
            });
        });
    </script>

</body>
<?php require_once "../js.php" ?>

</html>