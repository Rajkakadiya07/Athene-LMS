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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>


<body>
  <?php
  session_start();
  require_once "../connection.php";
  require_once "../sidebar.php";
  require_once "../header.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="">Dashboard</a></li>
        </ol>
      </nav>
    </div>





    <div class="card col-11 col-md-6 col-lg-11 ms-3">
      <div class="card-body">

        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home"
              type="button" role="tab" aria-controls="home" aria-selected="true">Timeline</button>
          </li>


        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
          <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
            <!-- course add space-->
            <div class="row  mt-3">
            <div class="col-11 col-md-6 col-lg-11 ms-3">
                <ul class="list-group list-group-flush">
                  <?php
                  $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as 
                  start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment, course_student where 
                  assignment.cse_id = course_student.cse_id and stud_id = '{$_SESSION['userid']}'                                        
                  union
                   select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material,
                    course_student where learning_material.cse_id = course_student.cse_id and stud_id = '{$_SESSION['userid']}'
                    union
                     SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
                   BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "'  limit 30                  
                   ";

                  if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                      // OUTPUT DATA OF EACH ROW
                      echo "<ol>";
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['activity'] == "assignment") {
                          echo "<li class='list-group-item mb-3'><a href='../assignment/view_assignment.php?agnId=$row[id]' class='text-dark'><i class='ri-book-read-fill h5'></i>" . $row["title"] . "</a></li>";
                        } else if ($row['activity'] == "LM") {
                          echo "<li class='list-group-item mb-3'><a href='../learning_material/view_materials.php?materialId=$row[id]' class='text-dark'><i class='ri-book-read-fill h5'></i>" . $row["title"] . "</a></li>";
                        }
                      }
                      echo "</ol>";
                    } else {
                      echo "No events found";
                    }
                  }

                  ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

            <!--second tab-->
          </div>

        </div>
        <!-- End  Tab -->

      </div>
    </div>

    <!-- Bordered Tabs -->




    <!-- End Page Title -->

  </main><!-- End #main -->

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
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTab"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>
  <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
<section class="section dashboard">


  <!-- Left side columns -->