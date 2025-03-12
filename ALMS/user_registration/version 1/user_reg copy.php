
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
                    <li class="breadcrumb-item active"><a href="#">User Registration</a></li>
                </ol>
            </nav>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Pending requests</h3>

                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Student</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Teacher</button>
                    </li>


                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade active show" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                        <div class='col-12'>
                            <div class='overflow-auto'>
                                <div class='card-body'>
                                    <table class='table table-borderless datatable' id='myTable'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>Enroll No</th>
                                                <th scope='col'>Name</th>
                                                <th scope='col'>Gender</th>
                                                <th scope='col'>Contact No</th>
                                                <th scope='col'>Email</th>
                                                <th scope='col'>Course</th>
                                                <th scope='col'>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>


                                            <?php
                                            require '../connection.php';

                                            $sql = "select * from pending_requests where usr_type = 'student'";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 1;
                                            while (($row = mysqli_fetch_assoc($result)) && $i < 100) {

                                                echo "<tr id='r" . $i . "'>
                                                      <td>" . $row['usr_id'] . "</td>
                                                      <td>" . $row['usr_name'] . "</td>";
                                                if ($row['usr_gender'] == "m") {
                                                    echo "<td>Male</td>";
                                                } else {
                                                    echo "<td>Female</td>";
                                                }
                                                echo "<td>" . $row['usr_contact_no'] . "</td>
                                                      <td>" . $row['usr_email'] . "</td>
                                                      <td>" . $row['usr_stud_category'] . "</td> 
                                                      <td><form id='forms{$i}' action='user_reg_into_db.php' method='post'><input type='submit' id='bas{$i}'  value='Approve' class='edit btn btn-primary btn-sm m-1' />" .
                                                    "<input type='submit' id='brs{$i}' value='Reject' class='delete btn btn-primary btn-sm m-1' /><span style='display:none'>{$row['usr_id']}</span></form></td>";
                                                $i++;
                                            }

                                            $i = 0;
                                            // $conn->close();


                                            ?>

                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class='col-12'>
                            <div class='overflow-hidden'>
                                <div class='card-body'>
                                    <table class='table table-borderless datatable' id='myTable'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>Teacher id</th>
                                                <th scope='col'>Name</th>
                                                <th scope='col'>Gender</th>
                                                <th scope='col'>Contact No</th>
                                                <th scope='col'>Email</th>
                                                <th scope='col'>Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>


                                            <?php
                                            require '../connection.php';

                                            $sql = "select * from pending_requests where usr_type = 'teacher'";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 101;
                                            while (($row = mysqli_fetch_assoc($result)) && $i > 100) {

                                                echo "<tr id='r" . $i . "'>
                                                      <td>" . $row['usr_id'] . "</td>
                                                      <td>" . $row['usr_name'] . "</td>";
                                                if ($row['usr_gender'] == "m") {
                                                    echo "<td>Male</td>";
                                                } else {
                                                    echo "<td>Female</td>";
                                                }
                                                echo "<td>" . $row['usr_contact_no'] . "</td>
                                                      <td>" . $row['usr_email'] . "</td>
                                                      <td><form id='formt{$i}' action='user_reg_into_db.php' method='post'><input type='submit' id='bat{$i}' value='Approve' class='edit btn btn-primary btn-sm m-1' />" .
                                                    "<input type='submit' value='Reject' id='brt{$i}' class='delete btn btn-primary btn-sm m-1' /><span style='display:none'>{$row['usr_id']}</span></form></td>";
                                                $i++;
                                            }

                                            $i = 101;
                                            $conn->close();


                                            ?>

                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-12">
            <div class="row pe-3">



            </div>
        </div>
        <!-- End Left side columns -->



        </div>
        </section>
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
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('input[type=submit]').on('click', function(e) {
                //console.log(e.target);
                button = e.target;
                form = e.target.parentElement;
                //console.log(form);
                $(form).on('submit', function(ev) {
                    ev.preventDefault();
                    //console.log(ev.target.id)
                    formUrl = $(form).attr("action");
                    val = $(form).children('span').html();
                    //console.log(val);

                    if (button.id.slice(0, 3) === "bas") {
                        $.ajax({
                            type: "POST",
                            url: formUrl,
                            data: {
                                
                                btnAcceptStudent: val
                            },
                            success: function(response) {
                                removeRowAccept(JSON.parse(response));
                            }
                        });
                        return false;
                    } else if (button.id.slice(0, 3) === "brs") {
                        $.ajax({
                            type: "POST",
                            url: formUrl,
                            data: {
                                btnRejectStudent: val
                            },
                            success: function(response) {
                                removeRowReject(JSON.parse(response));
                            }
                        });
                        return false;
                    } else if (button.id.slice(0, 3) === "bat") {
                        $.ajax({
                            type: "POST",
                            url: formUrl,
                            data: {
                                btnAcceptTeacher: val
                            },
                            success: function(response) {
                                removeRowAccept(JSON.parse(response));
                            }
                        });
                        return false;
                    } else if (button.id.slice(0, 3) === "brt") {
                        $.ajax({
                            type: "POST",
                            url: formUrl,
                            data: {
                                btnRejectTeacher: val
                            },
                            success: function(response) {
                                removeRowReject(JSON.parse(response));
                            }
                        });
                        return false;
                    }
                });
            });
        });

        function removeRowAccept(btn, response) {
            let btnId = btn.id;
            let no = response.id;
            btnId = btnId.slice(3); //It will give no of row in which response should be inserted in table
            if (response.errorcode == 1062) {
                message = "Student id: " + no + " already exists";
                document.getElementById('r' + btnId).innerHTML = "<td colspan='7'><div class='alert alert-warning alert-dismissible fade show' role='alert'>" +
                    "<i class='bi bi-exclamation-triangle me-1'></i>" + message + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
                    "</div></td>";
            } else {
                message = response.message;
                document.getElementById('r' + btnId).innerHTML = "<td colspan='7'><div class='alert alert-success alert-dismissible fade show' role='alert'>" +
                    "<i class='bi bi-check-circle me-1'></i>" + message + "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" +
                    "</div></td>";
            }
            //document.getElementById('r' + btnId).innerHTML = response;
            // const row = document.getElementById('r' + btnId);
            // $(row).fadeOut(1000,function(){
            //     $(row).remove(1000);
            // }) This code is used later for auto discard row functionality

        }

        function removeRowReject(btn, response) {
            let btnId = btn.id;
            let no = response.id;
            btnId = btnId.slice(3); //It will give no of row in which response should be inserted in table
            var message = response.message;
            document.getElementById('r' + btnId).innerHTML = `<td colspan='7'><div class='alert alert-danger alert-dismissible fade show' role='alert'>` +
                "<i class='bi bi-check-circle me-1'></i>" + message + `<button type='button' class='btn-close' onclick='removeTableRow("${'#r'.concat(btnId)}")'></button>` +
                "</div></td>";

            // const row = document.getElementById('r' + btnId);
            // $(row).fadeOut(1000,function(){
            //     $(row).remove(1000);
            // })
        }

        function removeTableRow(btnId) {
            row = btnId;
            $(row).fadeOut(1000, function() {
                $(row).remove(1000);
            })
        }
    </script>
</body>

</html>