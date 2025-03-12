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

  <?php include "../css.php"; ?>
  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <style>
    #field {
      margin-bottom: 20px;
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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body>
  <?php

  require_once "../connection.php";

  require_once "../sidebar.php";
  require_once "../header.php";


  $sql = "SELECT * FROM course WHERE cse_id = '{$_GET['cseId']}'";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $_SESSION['course'] = $result->fetch_assoc();
  } else {
    die("<h5>Please refresh page</h5>");
  }

  $sql = "SELECT * FROM category where cat_id = {$_SESSION['course']['cat_id']}";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    $_SESSION['category'] = $result->fetch_assoc();
  } else {
    die("<h5>Please refresh page</h5>");
  }


  if ($_SESSION['usertype'] == "Teacher") {


    $sql = "SELECT count(*) as count FROM course, course_teacher where course.cse_id = course_teacher.cse_id and course.cse_id = {$_SESSION['course']['cse_id']} and tchr_id = '{$_SESSION['userid']}'";
    if ($courseTeacher = mysqli_query($conn, $sql)) {
      if ($courseTeacher = $courseTeacher->fetch_assoc()['count'] != 1) {
        exit("
        <main id='main' class='main ps-0'>
            <div class='card'>
              <div class='card-body'>
                <h3 class='text-dark text-center mt-4'>You are not authorised to access this course</h3>
              </div>
            </div>
        </main>
        ");
      }
    }
  }


  ?>
  <main id="main" class="main ps-0">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Course</a></li>
          <li class="breadcrumb-item active"><a href="">
              <?php echo "{$_SESSION['course']['cse_full_name']} ({$_SESSION['course']['cse_short_name']})"; ?>
            </a></li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <!-- Accordion  -->

    <div class="card ms-3 col-11">
      <div class="card-body">

        <!-- Accordion without outline borders -->
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <?php
                if (empty($_SESSION['course']['cse_image'])) {
                  echo "<i class='bi bi-journal-text text-dark' class='text-middle'></i>";
                } else {
                  echo "<img src='{$_SESSION['course']['cse_image']}' width='50px' alt='{$_SESSION['course']['cse_short_name']}'>";
                }
                ?>
                <h5 class="card-title ms-2">
                  <?php echo "{$_SESSION['course']['cse_full_name']} ({$_SESSION['course']['cse_short_name']})"; ?>
                </h5>
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <h6 class="text-dark"><b>Category:</b>
                  <?php echo $_SESSION['category']['cat_full_name'] . " ({$_SESSION['category']['cat_short_name']})"; ?>
                </h6>
                <h6 class="text-dark"><b>Started on:</b>
                  <?php echo date("d-m-Y", strtotime($_SESSION['course']['cse_start_date'])); ?>
                </h6>
                <h6 class="text-dark"><b>End date:</b>
                  <?php echo empty($_SESSION['course']['cse_end_date']) ? "<p class='d-inline text-danger'>Not declared</p>" : date("d-m-Y", strtotime($_SESSION['course']['cse_end_date'])); ?>
                </h6>
                <p class="text-dark"><b>Course description:</b>
                  <?php echo nl2br($_SESSION['course']['cse_desc']); ?>
                </p>
              </div>
            </div>
          </div>
        </div><!-- End Accordion without outline borders -->

      </div>
    </div>


    <div class="card ms-3 col-11">
      <div class="card-body">
        <!-- <h5 class="card-title">Course</h5> -->

        <!-- Bordered Tabs -->
        <ul class=" mt-3 nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="mat-tab" data-bs-toggle="tab" data-bs-target="#bordered-mat"
              type="button" role="tab" aria-controls="mat" aria-selected="true"><i class="ri-book-read-fill h5"
                style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Materials</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="cie-tab" data-bs-toggle="tab" data-bs-target="#bordered-cie" type="button"
              role="tab" aria-controls="cie" aria-selected="false"><i class="ri-draft-fill h5"
                style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Assessments</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="assi-tab" data-bs-toggle="tab" data-bs-target="#bordered-assi" type="button"
              role="tab" aria-controls="assi" aria-selected="false"><i class="ri-clipboard-fill h5"
                style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Assignments</button>
          </li>
          <?php
          if ($_SESSION['usertype'] == "Teacher") {

            ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="conf-tab" data-bs-toggle="tab" data-bs-target="#bordered-conf" type="button"
                role="tab" aria-controls="conf" aria-selected="false"><i class="ri-file-list-2-fill h5"
                  style="font-size:20px; vertical-align: middle; margin-right:5px;"></i>Conferences</button>
            </li>
            <?php
          }

          if ($_SESSION['usertype'] != "Student") {
            echo "<li class='nav-item' role='presentation'>
              <button class='nav-link' id='addi-tab' data-bs-toggle='tab' data-bs-target='#bordered-addi' type='button' role='tab' aria-controls='addi' aria-selected='false'><i class='edit ri-add-circle-fill h5' style='font-size:20px; vertical-align: middle; margin-right:5px;'></i>New activity</button>
            </li>";
          }

          ?>
        </ul>

        <div class="tab-content pt-2" id="borderedTabContent">

          <!-- MATERIALS TAB -->
          <div class="tab-pane fade show active" id="bordered-mat" role="tabpanel" aria-labelledby="mat-tab">
            <!-- course add space -->

            <div class="row  mt-3">
              <div class="col-10">
                <ul class="list-group list-group-flush">
                  <?php
                  require_once "../course/materials_tab.php";
                  ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- ASSESSMENTS TAB -->
          <div class="tab-pane fade" id="bordered-cie" role="tabpanel" aria-labelledby="cie-tab">
            <div class="row  mt-3">
              <div class="col-10">
                <ul class="list-group list-group-flush">
                  <?php
                  require_once "../course/assessment_tab.php";
                  ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- ASSIGNMENTS TAB -->
          <div class="tab-pane fade" id="bordered-assi" role="tabpanel" aria-labelledby="assi-tab">
            <div class="row  mt-3">
              <div class="col-10">
                <ul class="list-group list-group-flush">
                  <?php require_once "../course/assignment_tab.php"; ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- CONFERENCES TAB -->
          <div class="tab-pane fade" id="bordered-conf" role="tabpanel" aria-labelledby="conf-tab">
            <div class="row  mt-3">
              <div class="col-10">
                <ul class="list-group list-group-flush">
                  <?php require_once "../course/conferences_tab.php"; ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bordered-addi" role="tabpanel" aria-labelledby="addi-tab">

            <!--divs that hide and show-->
            <div class="">
              <div class="col-xl-12 mt-3">
                <div class="row justify-content-center">
                  <div class="col-xl-8">
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Activity Type</label>
                      <div class="col-md-10 mt-2">
                        <select class="form-control">
                          <option>Choose Activity</option>
                          <option value="material">Add Material</option>
                          <option value="assign">Assignment</option>
                          <option value="poll">Choice poll</option>
                          <option value="conf">Conference</option>
                          <option value="quiz">Quiz</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!--divs that hide and show-->
            <div class="material for">
              <div class="col-xl-12 mt-3">
                <form action="../learning_material/add_learning_material_db.php" method="post"
                  enctype="multipart/form-data">
                  <div class="row justify-content-center">
                    <div class="col-xl-8">
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="short_description">Name</label>
                        <div class="col-md-10 mt-2">
                          <input type="text" class="form-control" id="course_title" name="name">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="short_description">Description</label>
                        <div class="col-md-10 mt-2">
                          <textarea type="text" class="form-control" id="course_title" col="70" row="8"
                            name="desc"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="short_description">Upload Date</label>
                        <div class="col-md-10">
                          <input type="datetime-local" class="StartDateTime form-control" id="course_title"
                            name="udate">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="short_description">Upload File</label>
                        <div class="col-md-10">
                          <input type="file" class="form-control" id="course_title" name="material">
                        </div>
                      </div>
                      <br>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="quiz for">
              <div class="col-xl-12 mt-3">
                <form action="../quiz/add_quiz.php" method="post">
                  <div class="row justify-content-center">
                    <div class="col-xl-8">
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Name</label>
                        <div class="col-md-10 mt-2">
                          <input type="text" class="form-control" id="quiz_name" name="qName">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Description</label>
                        <div class="col-md-10 mt-2">
                          <textarea type="text" class="form-control" id="quiz_desc" col="70" row="5"
                            name="qDesc"></textarea>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Password</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" id="quiz_password" name="qPass">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Start Time</label>
                        <div class="col-md-10">
                          <input type="datetime-local" class="StartDateTime form-control" id="start_time" name="sTime">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">End Time</label>
                        <div class="col-md-10">
                          <input type="datetime-local" class="form-control" id="end_time" name="eTime">
                        </div>
                      </div>

                      <br>
                      <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Create</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="assign for">
              <form name="assignmentForm" action="../assignment/assignment_create_db.php" method="post"
                enctype="multipart/form-data">
                <div class="row justify-content-center">
                  <div class="col-xl-8">
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Assignment Name</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="name">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Description</label>
                      <div class="col-md-10 mt-2">
                        <textarea type="text" class="form-control" id="course_title" col="70" row="5"
                          name="description"></textarea>
                      </div>


                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Total Marks</label>
                      <div class="col-md-10 mt-2">
                        <input type="number" class="form-control" id="course_title" name="totMarks">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Start Time</label>
                      <div class="col-md-10">
                        <input type="datetime-local" class="StartDateTime form-control" name="startDate">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">End Time</label>
                      <div class="col-md-10">
                        <input type="datetime-local" class="form-control" id="agnEndTime" name="endDate">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Additional File</label>
                      <div class="col-md-10">
                        <input type="file" class="form-control" id="course_title" name="attachment">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="poll for">
              <form name="pollForm" action="../poll/poll_create_db.php" method="post" enctype="multipart/form-data">
                <div class="row justify-content-center">
                  <div class="col-xl-8">

                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Poll Name</label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" name="poll_name" required>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Creation Time</label>
                      <div class="col-md-10">
                        <input type="datetime-local" class="StartDateTime form-control" name="startDate">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="poll_question">Poll question</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="poll_question" name="poll_question" required>
                      </div>
                    </div>

                    <!-- Poll options -->

                    <div class="row mb-5">
                      <label class="col-md-2 col-form-label text-dark">Options</label>
                      <div class="col-md-10 mt-2" id="pollOptions">
                        <input type="text" class="form-control mb-4" name="poll_options[]" placeholder="+ Option"
                          id="option1" required>
                        <input type="text" class="form-control mb-4" name="poll_options[]" placeholder="+ Option"
                          id="option2" required>
                        <span id="addMoreBtn" class="btn btn-primary">Add more</span>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="conf for">
              <div class="col-xl-12 mt-3">
                <form action="../conference/add_conf.php" id="conf_form" method="post">
                  <div class="row justify-content-center">
                    <div class="col-xl-8">
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Title</label>
                        <div class="col-md-10 mt-2">
                          <input type="text" class="form-control" id="conf_title" name="cName">
                          <span class="text-danger err-msg" id="error-message-1"></span>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Description</label>
                        <div class="col-md-10 mt-2">
                          <textarea type="text" class="form-control" id="conf_desc" col="70" row="5"
                            name="cDesc"></textarea>
                          <span class="text-danger err-msg" id="error-message-2"></span>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">Start Time</label>
                        <div class="col-md-10">
                          <input type="datetime-local" class="form-control" id="conf_start_datetime" name="sDateTime">
                          <span class="text-danger err-msg" id="error-message-3"></span>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label class="col-md-2 col-form-label text-dark" for="">End Time</label>
                        <div class="col-md-10">
                          <input type="datetime-local" class="form-control" id="conf_end_datetime" name="eDateTime">
                          <span class="text-danger err-msg" id="error-message-4"></span>
                        </div>

                      </div>

                      <br>
                      <div class="text-center">
                        <input type="submit" name="btnSubmit" class="btn btn-primary" value="Create" disabled>
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
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <script src="../validation/js/form_validation.js"></script>




  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script>
    // jQuery functions to hide and show the div
    $(document).ready(function () {

      // Autofill current dates to date input fields

      window.addEventListener("load", function () {
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        var localDatetime = year + "-" +
          (month < 10 ? "0" + month.toString() : month) + "-" +
          (day < 10 ? "0" + day.toString() : day) + "T" +
          (hour < 10 ? "0" + hour.toString() : hour) + ":" +
          (minute < 10 ? "0" + minute.toString() : minute);

        $('.StartDateTime').each((i, e) => {
          $(e).val(localDatetime);
        });
        var someDate = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        var localDatetime = year + "-" +
          (month < 10 ? "0" + month.toString() : month) + "-" +
          (day < 10 ? "0" + day.toString() : day) + "T" +
          (hour < 10 ? "0" + hour.toString() : hour) + ":" +
          (minute < 10 ? "0" + minute.toString() : minute);

        var numberOfDaysToAdd = 7;
        var result = someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
        enddate = new Date(result);
        var day = enddate.getDate();
        var localDatetime = year + "-" +
          (month < 10 ? "0" + month.toString() : month) + "-" +
          (day < 10 ? "0" + day.toString() : day) + "T" +
          (hour < 10 ? "0" + hour.toString() : hour) + ":" +
          (minute < 10 ? "0" + minute.toString() : minute);
        $("[name='endDate']").val(localDatetime);
      });

      $("select").change(function () {
        $(this).find("option:selected")
          .each(function () {
            var optionValue = $(this).attr("value");
            if (optionValue) {
              $(".for").not("." + optionValue).hide();
              $("." + optionValue).show();
            } else {
              $(".for").hide();
            }
          });
      }).change();
      var next = 3;

      $("#addMoreBtn").on("click", function () {
        nextId = "option" + next;
        inputBox = `<div id="` + nextId + `" class="row"><div class="col-11"><input type="text" class="form-control mb-4" name="poll_options[]" placeholder="+ Option"></div><div class="col-1"><span class="btn btn-primary removeOption" value="` + nextId + `">&#10006;</span></div></div>`;
        $(inputBox).insertBefore("#addMoreBtn");
        next += 1;
      });

      // #pollOptions is a div where input boxes will be added dynmically, .removeOptions is a class for spans that are buttons used to remove input boxes which are in divisions with
      // an id assigned to them, id is taken from span element to find each division

      $("#pollOptions").on("click", ".removeOption", function (e) {
        const elem = $(e.target).attr("value");
        console.log(elem);
        $('#' + elem).remove();
      });

      let startTime, endTime;

      let isValidTitle = false;
      let isValidDescription = true; // BY DEFAULT IT IS NOT REQUIRED SO IT CAN BE EMPTY ALSO
      let isValidStartTime = false;
      let isValidEndTime = false;

      let form = document.getElementById("conf_form");


      function btnSubmitStatus() {
        if (isValidTitle && isValidDescription && isValidStartTime && isValidEndTime) {
          form.btnSubmit.disabled = false;
        }
        else {
          form.btnSubmit.disabled = true;
        }
      }


      // VALIDATE CONFERENCE TITLE
      $('#conf_title').on('input', function () {
        let confTitle = $('#conf_title').val().trim();
        if (confTitle === '') {
          $('#error-message-1').text('Conference title is required');
          isValidTitle = false;
        } else if (confTitle.length > 100) {
          $('#error-message-1').text('Conference title must be at most 100 characters');
          isValidTitle = false;
        } else if (!/^[a-zA-Z0-9\s()\[\]{}\-]+$/.test(confTitle)) {
          $('#error-message-1').text('Conference title can only contain alphabets, numbers, brackets, hyphen, and spaces');
          isValidTitle = false;
        } else {
          $('#error-message-1').text('');
          isValidTitle = true;
        }
        btnSubmitStatus();
      });

      $('#conf_desc').on('input', function () {
        let confDesc = $('#conf_desc').val().trim();
        if (confDesc.length > 200) {
          $('#error-message-2').text('Conference description must be at most 200 characters');
          isValidDescription = false;
        } else if (!/^[a-zA-Z0-9\s()\[\]{}\-]+$/.test(confDesc)) {
          $('#error-message-2').text('Conference description can only contain alphabets, numbers, brackets, hyphen, and spaces');
          isValidDescription = false;
        } else {
          $('#error-message-2').text('');
          isValidDescription = true;
        }
        btnSubmitStatus();
      });

      // VALIDATE CONFERENCE START DATETIME
      $('#conf_start_datetime').on('input', function () {
        // Validate start time
        startTime = new Date($('#conf_start_datetime').val().trim());
        if (startTime === "") {
          $('#error-message-3').text('Invalid start time');
          isValidStartTime = false;
        } else {
          $('#error-message-3').text('');
          isValidStartTime = true;
        }
        btnSubmitStatus();
      });

      // VALIDATE CONFERENCE END DATETIME
      $('#conf_end_datetime').on('input', function () {
        // Validate end time
        endTime = new Date($('#conf_end_datetime').val().trim());
        if (endTime === "") {
          $('#error-message-4').text('Invalid end time');
          isValidEndTime = false;
        } else {
          $('#error-message-4').text('');
          isValidEndTime = true;
        }

        // Validate time difference
        let timeDifference = (endTime - startTime) / (1000 * 60);

        if (timeDifference < 2) {
          $('#error-message-4').text('There must be at least 2 minutes difference between start and end time');
          isValidEndTime = false;
        } else {
          isValidEndTime = true;
        }
        btnSubmitStatus();
      });




      // Assignment Form submission validation

      // $("[name='assignmentForm']").on('submit', function(e) {
      //   e.preventDefault();

      //   var name1 = document.forms.assignmentForm.name.value; //document (dom manipulation object)
      //   var desc = document.forms.assignmentForm.description.value; // forms (all forms in webpage)
      //   var sDate = document.forms.assignmentForm.startDate.value; // assignmentForm (form which has name attribute value regfrom) 
      //   var eDate = document.forms.assignmentForm.endDate.value; //fullname (form input which has name attribute value fullname)
      //   var totalMarks = document.forms.assignmentForm.totMarks.value;


      //   if (!valActivityName(name1)) {
      //     return false;
      //   } else if (!valDesc(desc)) {
      //     return false;
      //   } else if (dateCompare(sDate, eDate)) {
      //     console.log(sDate, eDate);
      //     return false;
      //   } else if (!valNumber(totalMarks)) {
      //     return false;
      //   } else {

      //     $.ajax({
      //       method: "post",
      //       url: "../assignment/assignment_create.php",
      //       data: {
      //         name: name1,
      //         description: desc,
      //         sdate: sDate,
      //         edate: eDate,
      //         totMarks: totalMarks
      //       },
      //       success: function(response) {
      // alert("Assignment added");
      //       }
      //     });
      //     return false;
      //   }

      // });

    });
  </script>

</body>

</html>