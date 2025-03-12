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

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }

        .card-image-top {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }


        .card-hover:hover {
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            /* Add a subtle downward shadow */
            z-index: 1;
            /* Bring the card above other elements */
            transition: 300ms;
        }

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

    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-error-warning-line text-primary h2"></i>
                        <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                        <p class="mt-2 text-dark" id="modalShortName"></p>
                        <p class="mt-2 text-dark" id="modalCourseName"></p>
                        <button type="button" class="btn btn-secondary my-2 close">Close</button>
                        <a class="icon" id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2" data-dismiss="modal">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Course</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">View Course</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Configure Course</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#AddTeacher" type="button" role="tab" aria-controls="profile" aria-selected="false">Assign
                                teacher</button>
                        </li>


                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- course add space-->
                            <?php
                            if (isset($_GET['cat_id'])) {
                                $sql = "SELECT * FROM course where cat_id = '{$_GET['cat_id']}'";
                            } else {
                                $sql = "SELECT * FROM course";
                            }
                            $result = mysqli_query($conn, $sql);
                            if (!empty($result->num_rows) && $result->num_rows > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($i % 2 == 1) {
                                        echo "<div class='row mt-3'>";
                                    }

                                    if (empty($row['cse_image'])) {
                                        $image = "<i class='bi bi-journal-text text-dark' style='font-size:100px;padding-left:20px;'></i>";
                                    } else {
                                        $image = "<img src='{$row['cse_image']}' width='100px' alt='{$row['cse_full_name']}'>";
                                    }
                                    echo "
                                        <div class='col-lg-6 col-md-6 col-sm-12 mb-3'>
                                        <div class='card card-hover'>
                                            <div class='filter'></div>
                                            <div class='row no-gutters'>
                                                <div class='col-12 col-sm-4'>
                                                <i class='bi bi-journal-text text-dark' style='font-size:100px;padding-left:20px;'></i>
                                                </div>
                                                <div class='col-12 col-sm-7'>
                                                    <div class='card-body'>
                                                        <h5 class='card-title'>
                                                            <a href='course_view.php?cseId={$row['cse_id']}' class='text-primary'>{$row['cse_short_name']}</a>
                                                        </h5>
                                                        <p class='text-muted d-block text-truncate'>{$row['cse_full_name']}</p>
                                                    </div>
                                                </div>
                                                <div class='col-12 col-sm-1 text-center'>
                                                    <div class='d-flex flex-row-reverse justify-content-between mt-2 '>
                                                        <a href='#' class='icon' data-bs-toggle='dropdown'><i class='bi bi-three-dots-vertical h5 text-dark'></i></a>
                                                        <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow'>
                                                            <li><a class='dropdown-item' href='course_edit.php?cse_id={$row['cse_id']}'>Edit</a></li>
                                                            <li><a class='dropdown-item del' link='course_db.php?courseId={$row['cse_id']}' full='{$row['cse_full_name']}'>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    ";

                                    if ($i % 2 == 0) {
                                        echo "</div>";
                                    }
                                    $i++;
                                }
                            } else {
                                echo "<h5 class='text-secondary my-3 text-center'>No courses are available</h5>";
                            }


                            ?>

                        </div>
                    </div>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="material for mt-4">
                                <div class="col-xl-12 mt-3">
                                    <form id="createCourse" action="course_db.php" method="post" enctype="multipart/form-data">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-8">
                                                <div class="mb-3">
                                                    <label class="form-label text-dark" for="inputCat">Category</label>
                                                    <select id="inputCat" name="csecategory" class="form-select" required>
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
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Course Semester</label>
                                                    <input type="text" class="form-control" name="csesem" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Course Name</label>
                                                    <input type="text" class="form-control" name="csename" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Course Short Name</label>
                                                    <input type="text" class="form-control" name="cseshortname" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark" for="description">Description</label>
                                                    <div class="quill-editor-full">
                                                        <textarea name="csedesc" class="form-control" rows="5" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label text-dark">Start Date</label>
                                                        <input type="date" id="startdate" class="form-control" name="csestartdate" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label text-dark">End Date</label>
                                                        <input type="date" class="form-control" name="cseenddate">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Course Icon</label>
                                                    <input type="file" class="form-control" name="cseimage">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-content pt-2">
                        <div class="tab-pane fade" id="AddTeacher" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="material mt-1">
                                <div class="container mt-1">
                                    <form id="createCourse" action="assign_teacher.php" method="post" enctype="multipart/form-data">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-8">
                                                <div class="mb-3">
                                                    <label class="form-label text-dark" for="Cat">Category</label>
                                                    <select id="Cat" name="category" class="form-select" required>
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
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Course</label>
                                                    <select name="courseId" id="course" class="form-select" required>
                                                        <option value="" selected>Select</option>
                                                        <!-- Populate options using JavaScript or server-side logic -->
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark">Teacher</label>
                                                    <select id="teacher" name="teacherId" class="form-select" required>
                                                        <option value="" selected>Select</option>
                                                        <?php
                                                        $sql = "select * from teacher";
                                                        $result = mysqli_query($conn, $sql);
                                                        if (!empty($result->num_rows) && $result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<option value='{$row['tchr_id']}'>{$row['tchr_name']}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Assign</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            function todayDate() {
                let d = new Date();
                let currDate = d.getDate();
                let currMonth = d.getMonth() + 1;
                let currYear = d.getFullYear();
                today = currYear + "-" + ((currMonth < 10) ? '0' + currMonth : currMonth) + "-" + ((currDate < 10) ? '0' + currDate : currDate);
                return today
            }
            $('#startdate').val(todayDate());

            $('#Cat').on('change', function() {
                var cid = $('#Cat :selected').val();
                $.ajax({
                    url: "ajax_course.php",
                    method: "post",
                    data: {
                        id: cid
                    },
                    success: function(response) {
                        document.getElementById('course').innerHTML = response;
                    }
                });
            });


            $(function() {
                $(".number").keypress(function(e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
                        return false;
                    }
                });
            });

            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();
                category = document.getElementById('csecategory').value;
                fullname = document.getElementById('csename').value;
                desc = document.getElementById('csedesc').value;
                startdate = document.getElementById('csestartdate').value;
                enddate = document.getElementById('cseenddate').value;

                if (fullname == "") {
                    return false;
                } else if (desc == "") {
                    return false;
                } else if (startdate == "") {
                    return false;
                } else if (enddate == "") {
                    return false;
                }

                form.submit();
            });


            $('.del').click(function(e) {
                console.log(e.target);
                $('#mod1').modal('show');
                courseName = $(e.target).attr('full');
                link = $(e.target).attr('link');
                console.log(courseName + link);
                $("#modalCourseName").html(courseName);
                $("#modalDeleteBtn").attr("href", link);

            });
            $('.close').click(function() {
                $('#mod1').modal('hide');
            });

            // Remove warnings after altered inputs

            $('input').on('input', function(e) {
                if (e.target.id == "shortname") {
                    $('#categoryShortName').hide();
                } else if (e.target.id == "fullname") {
                    $('#categoryFullName').hide();
                }
            });


        });
    </script>
    <?php require_once "../js.php" ?>
</body>


</html>