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
    <link href="../assets/jquery/datatables.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .modal-dialog {
            position: fixed;
            margin: auto;
            margin-top: 20px;
            width: 1100px;
            height: auto;
            right: 0px;

        }

        .modal-content {
            height: 100%;
        }
        /* Global Styles */
body {
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
}

/* Styles for Large Screens (Desktops) */
@media (min-width: 992px) {
    .modal-dialog {
        width: 1100px;
        margin-top: 50px;
    }

    .modal-content {
        height: auto;
    }

    .card {
        width: 90%;
        margin: 0 auto;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        font-size: 1.5rem;
    }

    .table {
        font-size: 14px;
    }
}

/* Styles for Medium Screens (Tablets) */
@media (max-width: 991px) {
    .modal-dialog {
        width: 90%;
        margin-top: 50px;
    }

    .modal-content {
        height: auto;
    }

    .card {
        width: 100%;
        margin: 0 auto;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.3rem;
    }

    .table {
        font-size: 12px;
    }
}

/* Styles for Small Screens (Mobile Phones) */
@media (max-width: 767px) {
    .modal-dialog {
        width: 100%;
        margin-top: 20px;
    }

    .modal-content {
        height: auto;
    }

    .card {
        width: 90%;
        margin: 0 auto;
    }

    .card-body {
        padding: 1rem;
    }

    .card-title {
        font-size: 1.2rem;
    }

    .table {
        font-size: 10px;
    }
}

    </style>
</head>


<body>
    <?php
    
    require_once "../connection.php";
    require_once "../sidebar.php";
    require_once "../header.php";


    $sql = "SELECT * FROM student, assignment_submission where student.stud_id = assignment_submission.stud_id and assignment_submission.agn_id = {$_SESSION['assignment']['agn_id']}";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
    } else {
        die("<h5>Please refresh page</h5>");
    }


    ?>


    <main id="main" class="main ps-0">
        <div class="pagetitle ms-2">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Course</a></li>
                    <li class="breadcrumb-item active"><a
                            href="course_view.php?cseId=<?php echo $_SESSION['course']['cse_id']; ?>">
                            <?php echo $_SESSION['course']['cse_full_name']; ?>
                        </a></li>
                    <li class="breadcrumb-item active"><a href="">
                            <?php echo $_SESSION['assignment']['agn_name']; ?>
                        </a></li>
                    <li class="breadcrumb-item active"><a href="">Submissions</a></li>
                </ol>
            </nav>
        </div>


        <div class="card  ps-1 col-11 recent-sales overflow-auto" style="color:black;">
            <div class="card-body">
                <h5 class="card-title">Submissions</h5>

                <table id="myTable" class="table table-borderless datatable dataTable-table">
                    <thead>
                        <tr>
                            <th scope="col" data-sortable="">Enrollment No.</th>
                            <th scope="col" data-sortable="">Name</th>
                            <th scope="col" data-sortable="">Status</th>
                            <th scope="col" data-sortable="">Submitted on</th>
                            <th scope="col" data-sortable="">File Submissions</th>
                            <th scope="col" data-sortable="">Grade</th>
                            <th scope="col" data-sortable="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($data = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$data['stud_id']}</td>
                                <td>{$data['stud_name']}</td>
                                <td>";
                            if ($data['agn_submission_status'] == 1) {
                                echo "<span class='badge bg-success'>Submitted</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Not submitted</span>";
                            }

                            if ($data['agn_submission_status'] == 1) {
                                echo "<td align='center'>" . date("d-m-Y h:i:s A", strtotime($data['agn_submission_date_time'])) . "</td>";
                            } else {
                                echo "<td align='center'> - </td>";
                            }

                            if (!empty($data['agn_submission_file'])) {
                                echo "<td align='center'><a href='./download.php?path={$data['agn_submission_file']}'>" . basename($data['agn_submission_file']) . "</a></td>";
                            } else {
                                echo "<td align='center'> - </td>";
                            }


                            if ($data['agn_submission_status'] == 1) {
                                if (!empty($data['agn_obtained_marks']) || $data['agn_obtained_marks'] == 0) {
                                    echo " 
                                        <td align='center'><span class='text-dark'>{$data['agn_obtained_marks']}/{$_SESSION['assignment']['agn_total_marks']}</span></td>";
                                } else {
                                    echo "
                                        <td align='center'><span class='text-dark'>Give grade</span></td>";
                                }
                            } else {
                                echo "<td align='center'> - </td>";
                            }

                            if ($data['agn_submission_status'] == 1) {
                                if (!empty($data['agn_obtained_marks']) || $data['agn_obtained_marks'] == 0) {
                                    echo " 
                                        <td align='center'><a href='grade.php?agnId={$_SESSION['assignment']['agn_id']}&studId={$data['stud_id']}'><span class='badge bg-primary'>Update grade</span></a></td>";
                                } else {
                                    echo "
                                        <td align='center'><a href='grade.php?agnId={$_SESSION['assignment']['agn_id']}&studId={$data['stud_id']}'><span class='badge bg-primary'>Grade</span></a></td>
                                        ";
                                }
                            } else {
                                echo "<td align='center'> - </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">



    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
    <script src="../assets/jquery/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            let table = new DataTable('#myTable');
        });
    </script>

</body>

</html>