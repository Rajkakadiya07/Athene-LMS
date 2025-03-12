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

    <?php require_once "../css.php" ?>

    <style>
        body::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="">
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
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Student</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false" tabindex="-1">Teacher</button>
                    </li>


                </ul>
                <div class="tab-content pt-2" id="borderedTabContent">
                    <div class="tab-pane fade active show" id="bordered-home" role="tabpanel"
                        aria-labelledby="home-tab">
                        <div class='col-12'>
                            <div class='overflow-auto'>
                                <div class='card-body'>
                                    <table class='table table-borderless datatable' id='myTable'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>
                                                    <input type='checkbox' id="selectalls" title="Select all">
                                                </th>
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

                                            $sql = "select * from pending_requests where usr_type = 'student'";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 0;
                                            while (($row = mysqli_fetch_assoc($result))) {

                                                echo "<tr id='rs" . $i . "'>
                                                      <td><input type='checkbox' class='checkboxs' id='chkboxs" . $i . "' name='userids[]' value='{$row['usr_id']}'</td>
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
                                                      <td><form id='forms{$i}' action='user_reg_into_db.php' method='post'><input type='submit' id='bas{$i}'  value='&#10004;' class='edit btn btn-primary btn-sm m-1' />" .
                                                    "<input type='submit' id='brs{$i}' value='&#10006;' class='delete btn btn-primary btn-sm m-1' /><span style='display:none'>{$row['usr_id']}</span></form></td>";
                                                $i++;
                                            }

                                            $i = 0;
                                            // $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                    <input type="submit" value="Approve" class="btn btn-primary"
                                        name="approveAllStudents">
                                    <input type="submit" value="Reject" class="btn btn-primary"
                                        name="rejectAllStudents">
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
                                                <th scope='col'><input type='checkbox' id="selectallt"
                                                        title="Select all"></th>
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

                                            $sql = "select * from pending_requests where usr_type = 'teacher'";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 0;
                                            while (($row = mysqli_fetch_assoc($result))) {

                                                echo "<tr id='rt" . $i . "'>
                                                      <td><input type='checkbox' class='checkboxt' id='chkbox" . $i . "' name='userids[]' value='{$row['usr_id']}'</td>
                                                      <td>" . $row['usr_id'] . "</td>
                                                      <td>" . $row['usr_name'] . "</td>";
                                                if ($row['usr_gender'] == "m") {
                                                    echo "<td>Male</td>";
                                                } else {
                                                    echo "<td>Female</td>";
                                                }
                                                echo "<td>" . $row['usr_contact_no'] . "</td>
                                                      <td>" . $row['usr_email'] . "</td>
                                                      <td><form id='formt{$i}' action='user_reg_into_db.php' method='post'><input type='submit' id='bat{$i}' value='&#10004;' class='edit btn btn-primary btn-sm m-1' />" .
                                                    "<input type='submit' value='&#10006;' id='brt{$i}' class='delete btn btn-primary btn-sm m-1' /><span style='display:none'>{$row['usr_id']}</span></form></td>";
                                                $i++;
                                            }

                                            $i = 0;
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

    <?php require_once "../js.php" ?>


    <script>
        $(document).ready(function () {
            $('input[type=submit]').on('click', function (e) {
                //console.log(e.target);
                buttonid = e.target.id;
                form = e.target.parentElement;
                //console.log(form);
                $(form).on('submit', function (ev) {
                    ev.preventDefault();
                    //console.log(ev.target.id)
                    formUrl = $(form).attr("action");
                    val = $(form).children('span').html();
                    //console.log(val);

                    $.ajax({
                        type: "POST",
                        url: formUrl,
                        data: {
                            buttonId: buttonid,
                            userId: val
                        },
                        success: function (response) {
                            obj = JSON.parse(response); // Converting string json format to JS Object
                            if (obj.btnid.slice(0, 2) == "ba") {
                                removeRowAccept(obj);
                                sendMail(obj);
                            } else {
                                removeRowReject(obj);
                                sendMail(obj);
                            }
                        }
                    });
                    return false;
                });
            });


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
        });

        function removeRowAccept(response) {
            let no = response.id;
            let btnId = response.btnid.slice(2); //It will give no of row in which response should be inserted in table
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

        function removeRowReject(response) {
            let btnId = response.btnid;
            let no = response.id;
            btnId = btnId.slice(2); //It will give no of row in which response should be inserted in table
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
            $(row).fadeOut(1000, function () {
                $(row).remove(1000);
            })
        }


        function sendMail(response) {
            $.ajax({
                method: "post",
                url: "user_reg_mail.php",
                data: {
                    userEmail: response.email,
                    subject: response.subject,
                    emailMessage: response.emailMessage
                }
            });
        }


        $('.toggle-sidebar-btn').on('click', '.toggle-sidebar-btn', function (e) {
            select('body').classList.toggle('toggle-sidebar')
        });

    </script>
</body>

</html>