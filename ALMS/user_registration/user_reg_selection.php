<?php
session_start();
require '../connection.php';

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
        body::-webkit-scrollbar {
            display: none;
        }

        .black-icon {
            filter: invert();
        }
        
        @media (max-width: 768px) {
            .card {
                margin: 10px 0;
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

        @media (max-width: 767px) {
            .nav-tabs {
                flex-direction: column;
                text-align: left;
            }

            .nav-link {
                width: 100%;
                margin-bottom: 5px;
            }

            .tab-pane {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>


    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Users</a></li>
                </ol>
            </nav>
        </div>


        <div class="card">
            <div class="card-body" style='color:black;'>

                <ul class="nav nav-tabs nav-tabs-bordered mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#pending-requests" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Pending requests</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#registered-users" type="button" role="tab" aria-controls="profile"
                            aria-selected="false" tabindex="-1">Registered users</button>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="">
                    <div class="tab-pane fade active show" id="pending-requests" role="tabpanel"
                        aria-labelledby="home-tab">

                        <!-- <div class="card">
                            <div class="card-body" style='color:black;'> -->
                                <h3 class="card-title ps-3  ">Pending requests</h3>

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-home" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Student</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#bordered-profile" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false" tabindex="-1">Teacher</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2" id="">
                                    <div class="tab-pane fade active show" id="bordered-home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class='col-12'>
                                            <form action="reg_selected_users.php" method="post">
                                            <div class='overflow-auto table-responsive'>
                                                    <div class='card-body'>
                                                        <table class='table table-borderless datatable' id='myTable1'>
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>
                                                                        <input type='checkbox' id="selectalls"
                                                                            title="Select all">
                                                                    </th>
                                                                    <th scope='col'>Enroll No</th>
                                                                    <th scope='col'>Name</th>
                                                                    <th scope='col'>Gender</th>
                                                                    <th scope='col'>Contact No</th>
                                                                    <th scope='col'>Email</th>
                                                                    <th scope='col'>Course</th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                require '../connection.php';

                                                                $sql = "select * from pending_requests where usr_type = 'student'";
                                                                $result = mysqli_query($conn, $sql);
                                                                while (($row = mysqli_fetch_assoc($result))) {

                                                                    $catCode = substr($row['usr_id'], 4, 8);
                                                                    $coursesOfCatQuery = "SELECT cat_short_name FROM category WHERE cat_code = {$catCode}";
                                                                    if ($categoryData = mysqli_query($conn, $coursesOfCatQuery)) {
                                                                        if ($categoryData->num_rows == 1) {
                                                                            if ($categoryName = $categoryData->fetch_assoc()) {
                                                                                $catName = $categoryName['cat_short_name'];
                                                                            }
                                                                        }
                                                                    }

                                                                    echo "<tr>
                                                                          <td><input type='checkbox' class='checkboxs' name='userids[]' value='{$row['usr_id']}'</td>
                                                                          <td>" . $row['usr_id'] . "</td>
                                                                          <td>" . $row['usr_name'] . "</td>";
                                                                    if ($row['usr_gender'] == "m") {
                                                                        echo "<td>Male</td>";
                                                                    } else {
                                                                        echo "<td>Female</td>";
                                                                    }
                                                                    echo "<td>" . $row['usr_contact_no'] . "</td>
                                                                          <td>" . $row['usr_email'] . "</td>
                                                                          <td>" . $catName . "</td>";
                                                                }

                                                                // $conn->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <input type="submit" value="Approve" class="btn btn-primary"
                                                            name="approveAllStudents">
                                                        <input type="submit" value="Reject" class="btn btn-danger"
                                                            name="rejectAllStudents">
                                                    </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="bordered-profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class='col-12'>
                                    <div class="table-responsive">
                                        <form action="reg_selected_users.php" method="post">
                                        <div class='overflow-auto table-responsive'>
                                                <div class='card-body'>
                                                    <table class='table table-borderless text-nowrap' id='myTable2'>
                                                        <thead>
                                                            <tr>
                                                                <th scope='col'><input type='checkbox' id="selectallt"
                                                                        title="Select all"></th>
                                                                <th scope='col'>Teacher id</th>
                                                                <th scope='col'>Name</th>
                                                                <th scope='col'>Gender</th>
                                                                <th scope='col'>Contact No</th>
                                                                <th scope='col'>Email</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>


                                                            <?php
                                                            $i=0;
                                                            require '../connection.php';

                                                            $sql = "select * from pending_requests where usr_type = 'teacher'";
                                                            $result = mysqli_query($conn, $sql);
                                                            while (($row = mysqli_fetch_assoc($result))) {

                                                                echo "<tr>
                                                                      <td><input type='checkbox' class='checkboxt' name='useridt[]' value='{$row['usr_id']}'</td>
                                                                      <td>" . $row['usr_id'] . "</td>
                                                                      <td>" . $row['usr_name'] . "</td>";
                                                                if ($row['usr_gender'] == "m") {
                                                                    echo "<td>Male</td>";
                                                                } else {
                                                                    echo "<td>Female</td>";
                                                                }
                                                                echo "<td>" . $row['usr_contact_no'] . "</td>
                                                                      <td>" . $row['usr_email'] . "</td>";
                                                                $i++;
                                                            }

                                                            $conn->close();


                                                            ?>

                                                        </tbody>
                                                    </table>
                                                    <input type="submit" value="Approve" class="btn btn-primary"
                                                        name="approveAllTeachers">
                                                    <input type="submit" value="Reject" class="btn btn-danger"
                                                        name="rejectAllTeachers">
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

                <div class="tab-content" id="">

                    <div class="tab-pane fade" id="registered-users" role="tabpanel" aria-labelledby="profile-tab">

                        <!-- <div class="card"> -->
                            <div class="card-body" style='color:black;'>
                                <h3 class="card-title ms-3">Registered users</h3>

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#registered-students" type="button" role="tab"
                                            aria-controls="home" aria-selected="true">Student</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#registered-teachers" type="button" role="tab"
                                            aria-controls="profile" aria-selected="false" tabindex="-1">Teacher</button>
                                    </li>


                                </ul>
                                <div class="tab-content " id="">
                                    <div class="tab-pane fade active show" id="registered-students" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class='col-12 mt-2'>
                                            <form action="reg_selected_users.php" method="post">
                                            <div class='overflow-auto table-responsive'>
                                                    <div class='card-body'>
                                                        <table class='table table-borderless' id='myTable3'>
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Select</th>
                                                                    <th scope='col'>Enroll No</th>
                                                                    <th scope='col'>Name</th>
                                                                    <th scope='col'>Gender</th>
                                                                    <th scope='col'>Course</th>
                                                                    <th scope='col'>Status</th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                require '../connection.php';

                                                                $sql = "select * from student";
                                                                $result = mysqli_query($conn, $sql);
                                                                while (($row = mysqli_fetch_assoc($result))) {

                                                                    $catCode = substr($row['stud_id'], 4, 8);
                                                                    $coursesOfCatQuery = "SELECT cat_short_name FROM category WHERE cat_code = {$catCode}";
                                                                    if ($categoryData = mysqli_query($conn, $coursesOfCatQuery)) {
                                                                        if ($categoryData->num_rows == 1) {
                                                                            if ($categoryName = $categoryData->fetch_assoc()) {
                                                                                $catName = $categoryName['cat_short_name'];
                                                                            }
                                                                        }
                                                                    }

                                                                    echo "<tr>
                                                                          <td><input type='checkbox' class='checkboxs' name='' value='{$row['stud_id']}'</td>
                                                                          <td>" . $row['stud_id'] . "</td>
                                                                          <td>" . $row['stud_name'] . "</td>";
                                                                    if ($row['stud_gender'] == "m") {
                                                                        echo "<td>Male</td>";
                                                                    } else {
                                                                        echo "<td>Female</td>";
                                                                    }
                                                                    echo "<td>" . $catName . "</td>";
                                                                    echo "<td>";
                                                                    if ($row['stud_suspend'] == 1) {
                                                                        echo "{$row['stud_suspend']}<span class='badge bd-danger'>Disabled</span>";
                                                                    } else {
                                                                        echo "<span class='badge bd-success'>Active</span>";
                                                                    }
                                                                    echo "</td>";
                                                                }

                                                                // $conn->close();
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content" id="">

                                    <div class="tab-pane fade" id="registered-teachers" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class='col-12 mt-2'>
                                            <form action="reg_selected_users.php" method="post">
                                            <div class='overflow-auto table-responsive'>
                                                    <div class='card-body'>
                                                        <table class='table table-borderless text-nowrap' id='myTable4'>
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Select</th>
                                                                    <th scope='col'>Teacher id</th>
                                                                    <th scope='col'>Name</th>
                                                                    <th scope='col'>Gender</th>
                                                                    <th scope='col'>Status</th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>


                                                                <?php
                                                                require '../connection.php';

                                                                $sql = "select * from teacher";
                                                                $result = mysqli_query($conn, $sql);
                                                                while (($row = mysqli_fetch_assoc($result))) {

                                                                    echo "<tr>
                                                                          <td><input type='checkbox' class='checkboxs' name='' value='{$row['tchr_id']}'</td>
                                                                          <td>" . $row['tchr_id'] . "</td>
                                                                          <td>" . $row['tchr_name'] . "</td>";
                                                                    if ($row['tchr_gender'] == "m") {
                                                                        echo "<td>Male</td>";
                                                                    } else {
                                                                        echo "<td>Female</td>";
                                                                    }

                                                                    if ($row['tchr_suspend'] == 1) {
                                                                        echo "<td><span class='badge bg-danger'>Disabled</span></td>";
                                                                    } else {
                                                                        echo "<td><span class='badge bg-success'>Active</span></td>";
                                                                    }

                                                                }

                                                                $conn->close();
                                                                ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <!-- </div>
                            </div> -->
                        </div>
                    </div>
                <!-- </div> -->
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
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="../assets/jquery/datatables.min.js"></script>

    <script>
        let table1 = new DataTable('#myTable1');
        let table2 = new DataTable('#myTable2');
        let table3 = new DataTable('#myTable3');
        let table4 = new DataTable('#myTable4');

        $(document).ready(function () {
            // $('input[type=submit]').on('click', function(e) {
            //     //console.log(e.target);
            //     buttonid = e.target.id;
            //     form = e.target.parentElement;
            //     //console.log(form);
            //     $(form).on('submit', function(ev) {
            //         ev.preventDefault();
            //         //console.log(ev.target.id)
            //         formUrl = $(form).attr("action");
            //         val = $(form).children('span').html();
            //         //console.log(val);

            //         $.ajax({
            //             type: "POST",
            //             url: formUrl,
            //             data: {
            //                 buttonId: buttonid,
            //                 userId: val
            //             },
            //             success: function(response) {
            //                 obj = JSON.parse(response); // Converting string json format to JS Object
            //                 if (obj.btnid.slice(0, 2) == "ba") {
            //                     removeRowAccept(obj);
            //                     sendMail(obj);
            //                 } else {
            //                     removeRowReject(obj);
            //                     sendMail(obj);
            //                 }
            //             }
            //         });
            //         return false;
            //     });
            // });


            $('#selectalls').on('click', function () {
                if (this.checked) {
                    $('.checkboxs').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkboxs').each(function () {
                        this.checked = false;
                    });
                }
            });

            $('#selectallt').on('click', function () {
                if (this.checked) {
                    $('.checkboxt').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.checkboxt').each(function () {
                        this.checked = false;
                    });
                }
            });
        });

        // function removeRowAccept(response) {
        //     let no = response.id;
        //     let btnId = response.btnid.slice(2); //It will give no of row in which response should be inserted in table
        //     if (response.errorcode == 1062) {
        //         message = "Student id: " + no + " already exists";
        //         document.getElementById('r' + btnId).innerHTML = "<td colspan='7'><div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
        //             "<i class='bi bi-exclamation-triangle me-1'></i>" + message + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
        //             "</div></td>";
        //     } else {
        //         message = response.message;
        //         document.getElementById('r' + btnId).innerHTML = "<td colspan='7'><div class='alert alert-success alert-dismissible fade show' role='alert'>" +
        //             "<i class='bi bi-check-circle me-1'></i>" + message + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
        //             "</div></td>";
        //     }
        //     //document.getElementById('r' + btnId).innerHTML = response;
        //     // const row = document.getElementById('r' + btnId);
        //     // $(row).fadeOut(1000,function(){
        //     //     $(row).remove(1000);
        //     // }) This code is used later for auto discard row functionality

        // }

        // function removeRowReject(response) {
        //     let btnId = response.btnid;
        //     let no = response.id;
        //     btnId = btnId.slice(2); //It will give no of row in which response should be inserted in table
        //     var message = response.message;
        //     document.getElementById('r' + btnId).innerHTML = `<td colspan='7'><div class='alert alert-danger alert-dismissible fade show' role='alert'>` +
        //         "<i class='bi bi-check-circle me-1'></i>" + message + `<button type='button' class='btn-close' onclick='removeTableRow("${'#r'.concat(btnId)}")'></button>` +
        //         "</div></td>";

        //     // const row = document.getElementById('r' + btnId);
        //     // $(row).fadeOut(1000,function(){
        //     //     $(row).remove(1000);
        //     // })
        // }

        // function removeTableRow(btnId) {
        //     row = btnId;
        //     $(row).fadeOut(1000, function() {
        //         $(row).remove(1000);
        //     })
        // }


        // function sendMail(response) {
        //     $.ajax({
        //         method: "post",
        //         url: "user_reg_mail.php",
        //         data: {
        //             userEmail: response.email,
        //             subject: response.subject,
        //             emailMessage: response.emailMessage
        //         }
        //     });
        // }
    </script>
         <?php require_once "../js.php" ?>
</body>

</html>