<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
/* Default styles for larger screens */
/* Add your existing CSS styles here */

/* Media query for tablets */
@media (max-width: 768px) {
    /* Add styles specific for tablets here */
    /* You can adjust font sizes, paddings, margins, etc. */
}

/* Media query for mobile devices */
@media (max-width: 576px) {
    /* Add styles specific for mobile devices here */
    /* You can further adjust font sizes, paddings, margins, etc. */
    body {
        font-size: 14px; /* Example: Decrease the default font size for better readability on smaller screens */
    }
    .card-title {
        font-size: 18px; /* Example: Adjust the card title font size for smaller screens */
    }
    .modal-dialog {
        max-width: 90%; /* Example: Make the modal content occupy 90% of the screen width on mobile */
    }
    /* Add more specific styles as needed for a better mobile experience */
}
    

img {
    max-width: 100%;
    height: auto;
}
/* Default styles for modal */
.modal-dialog {
  position: fixed;
  margin: auto;
  margin-top: 20px;
  width: 90%; /* Adjust the width as needed */
  height: auto;
  right: 0;
  left: 0;
}

/* Media query for smaller screens (e.g., tablets) */
@media (max-width: 768px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 30px); /* Set max height for the modal */
  }
}

/* Media query for even smaller screens (e.g., mobile phones) */
@media (max-width: 576px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for even smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 15px); /* Set max height for the modal */
  }
}


    </style>
</head>


<body>
    <?php
    session_start();

    date_default_timezone_set('Asia/Kolkata');

    require_once "../connection.php";
    require_once "../sidebar.php";
    require_once "../header.php";

    $sql = "SELECT * FROM learning_material WHERE lm_id = '{$_GET['materialId']}'";
    $result = mysqli_query($conn, $sql);
    echo $result->num_rows;
    if ($result->num_rows > 0) {
        $_SESSION['LM'] = $result->fetch_assoc();
    } else {
        die("<h5>Please refresh page</h5>");
    }
    ?>


    <main id="main" class="main ps-0">

        <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="ri-error-warning-line text-primary h2"></i>
                            <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                            <p class="mt-2 text-dark" id="modalCourseName">
                                <?= $_SESSION['LM']['lm_name'] ?>
                            </p>
                            <button type="button" class="btn btn-secondary my-2 close">Close</button>
                            <a class="icon"
                                href="delete_learning_material.php?materialId=<?= $_SESSION['LM']['lm_id'] ?>"
                                id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2"
                                    data-dismiss="modal">Delete</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagetitle ms-2">
            <?php
            if (!empty($_SESSION['course'])) {
                echo "<nav>
                <ol class='breadcrumb'>
                    <li class='breadcrumb-item'><a href=''>Course</a></li>
                    <li class='breadcrumb-item active'><a href='course_view.php?cseId={$_SESSION['course']['cse_id']}'>{$_SESSION['course']['cse_full_name']}</a></li>    
                    <li class='breadcrumb-item active'><a href=''>{$_SESSION['LM']['lm_name']}</a></li>
                </ol>
            </nav>";
            }
            ?>
        </div>
        <!-- End Page Title -->

        <div class="card ms-3 col-11">
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <h5 class="card-title"><i class="ri-clipboard-fill h5 align-middle me-1"></i>
                            <?php echo $_SESSION['LM']['lm_name']; ?>
                        </h5>
                    </div>
                    <?php
                    if ($_SESSION['usertype'] != "Student") {
                        echo "
                        <div class='col-12 col-md-2 mt-3'>
                        <div class='row'>
                            <div class='col-6'>
                                <a href='learning_material_edit.php'><button class='btn btn-sm  btn-primary w-100'>Edit</button></a>
                            </div>
                            <div class='col-6'>
                                <button id='del' class='btn btn-sm btn-primary w-100'>Delete</button>
                            </div>
                        </div>
                    </div>
                    
                            ";
                    }
                    ?>
                </div>

                <div class="mb-4"></div>
                <span class="text-dark h6"><b>Uploaded on: </b>
                    <?php echo date("d-m-Y h:i:s A", strtotime($_SESSION['LM']['lm_upload_date_time'])); ?>
                </span>
                <hr class="text-dark">
                <h5 class="text-dark">Description</h5>
                <span class="text-dark h6">
                    <?php echo nl2br($_SESSION['LM']['lm_desc']); ?>
                </span>


                <?php
                if (!empty($_SESSION['LM']['lm_file'])) {
                    echo "<hr class='text-dark'><h5 class='text-dark'>Attached file</h5>";
                    echo "<span class='text-dark h6'>" . basename($_SESSION['LM']['lm_file']) . " <a class='ms-3' href='./download.php?path={$_SESSION['LM']['lm_file']}'>
                    <button type='button' class='btn btn-primary btn-sm'>Download</button>
                    </a></span>";
                    if ($_SESSION['usertype'] == "Teacher" || $_SESSION['usertype'] == "Admin") {
                        echo "<a  class='ms-2 mt-2' href='delete_learning_material_file.php?path={$_SESSION['LM']['lm_file']}'>Remove file</a>";
                    }
                } else {
                    if ($_SESSION['usertype'] != "Student") {
                        echo "<hr class='text-dark'><h5 class='text-dark'>Upload file</h5>";

                        echo "
                        <form action='update_learning_material_file.php' method='post' enctype='multipart/form-data'>
                        <div class='row mb-3'>
                          <label class='col-md-2 col-form-label text-dark' for='short_description'>Add File</label>
                          <div class='col-md-10 d-flex'>
                            <input type='file' class='form-control w-50' id='course_title' name='attachment' required>
                            <input type='submit' class='btn btn-primary ms-5' value='Upload'>
                          </div>
                        </div></form>";
                    }
                }
                ?>
            </div>
        </div>
    </main>





    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>



    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
    <script>
        $(document).ready(function () {

            $('#del').click(function (e) {
                $('#mod1').modal('show');
            });

            $('.close').click(function () {
                $('#mod1').modal('hide');
            });
        });
    </script>

</body>

</html>