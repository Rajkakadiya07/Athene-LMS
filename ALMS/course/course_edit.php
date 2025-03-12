<?php
session_start();

$_SESSION['cse_id'] = $_GET['cse_id'];
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
    </style>
</head>

<body>
    <?php
    require_once "../sidebar.php";
    require_once "../header.php";
    require("../connection.php");

    $sql = "select * from course where cse_id = {$_GET['cse_id']}";
    $result = mysqli_query($conn, $sql);
    if (!empty($result->num_rows) && $result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $sem = $row['cse_semester'];
        $name = $row['cse_full_name'];
        $shortname = $row['cse_short_name'];
        $desc = $row['cse_desc'];
        $startdate = $row['cse_start_date'];
        $enddate = $row['cse_end_date'];
        $image = $row['cse_image'];
    }
    ?>

    <main id="main" class="main">



        <div class="card ms-3 col-11 ">
            <div class="card-body">
                <h5 class="card-title">Edit Course</h5>
                <div class="d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="">Course / Edit Course</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="card ms-3 col-11">
    <div class="material for mt-4">
        <div class="col-xl-12 m-4">
            <form id="createCourse" action="course_db.php" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label text-dark">Course Semester</label>
                            <input type="text" class="form-control" name="ucsesem" placeholder="Enter Semester Number" value="<?php echo isset($sem) ? $sem : ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Course Name</label>
                            <input type="text" class="form-control" name="ucsename" placeholder="Enter Full Name" value="<?php echo isset($name) ? $name : ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Course Short Name</label>
                            <input type="text" class="form-control" name="ucseshortname" placeholder="Enter Short Name" value="<?php echo isset($shortname) ? $shortname : ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark" for="description">Description</label>
                            <div class="quill-editor-full">
                                <textarea id="txtarea" name="ucsedesc" class="form-control" rows="5"><?php echo isset($desc) ? htmlspecialchars($desc) : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Start Date</label>
                            <input type="date" id="ustartdate" class="form-control" name="ucsestartdate" value="<?php echo isset($startdate) ? $startdate : ""; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">End Date</label>
                            <input type="date" class="form-control" name="ucseenddate" value="<?php echo isset($enddate) ? $enddate : ""; ?>">
                        </div>
                        <?php
                            if(!empty($image)){
                                echo "
                                <div class='mb-3'>
                                    <label class='form-label text-dark'>Course Icon</label>
                                    <div class='border justify-content-evenly d-flex align-items-center'>
                                        <img width='100px' src='$image'>
                                        <a href='remove_course_icon.php?path=$image&cse_id={$_GET['cse_id']}'>remove icon</a>
                                    </div>
                                </div>
                                ";
                            }else{
                                echo "
                                <div class='mb-3'>
                                    <label class='form-label text-dark'>Course Icon</label>
                                    <input type='file' class='form-control' name='ucseimage'>
                                </div>
                                ";
                            }
                        ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


        </div>

        <!--second tab-->

        <!-- End  Tab -->
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
        $(document).ready(function() {
            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();

                form.submit();
            });
        value = <?php echo isset($desc) ? htmlspecialchars($desc) : ""; ?>
        document.getElementById("txtarea").value = value;

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


</html>