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
  /* Default styles */

/* Add your default styles here */

/* Media queries for responsiveness */

/* Small devices (phones) */
@media (max-width: 576px) {
  body {
    font-size: 14px; /* Adjust font size for smaller screens */
  }

  .card {
    margin: 10px; /* Add margin for cards on small screens */
  }

  .nav-tabs {
    flex-direction: column; /* Stack tabs vertically on small screens */
  }

  .nav-tabs .nav-link {
    width: 100%; /* Make tabs take full width on small screens */
  }

  .list-group-item {
    font-size: 0.9rem; /* Adjust font size for list items on small screens */
  }

  .footer {
    text-align: center; /* Center align text in the footer on small screens */
  }
}

/* Medium devices (tablets) */
@media (max-width: 768px) {
  body {
    font-size: 16px; /* Default font size for medium screens */
  }

  .card {
    margin: 15px; /* Add margin for cards on medium screens */
  }
}

/* Large devices (desktops) */
@media (max-width: 992px) {
  /* Add styles for large screens if needed */
}

/* Extra large devices (large desktops) */
@media (max-width: 1200px) {
  /* Add styles for extra large screens if needed */
}

/* XXL devices (larger desktops) */
@media (min-width: 1400px) {
  /* Add styles for XXL screens if needed */
}

</style>
</head>



<body>
  <?php
  session_start();
  require_once "../connection.php";
  require_once "../header.php";
  require_once "../sidebar.php";
  ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="./teacher.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>


    <section class="section dashboard">
      <div class="row">
        <div class="card col-11">
          <div class="card-body">
            <!-- <h5 class="card-title">Course</h5> -->

            <!-- Bordered Tabs -->
            <ul class="mt-3 nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mat-tab" data-bs-toggle="tab" data-bs-target="#bordered-mat"
                  type="button" role="tab" aria-controls="mat" aria-selected="true"><i class="ri-book-read-fill h5"></i>
                  Recent Activity</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabContent">
              <div class="tab-pane fade show active" id="bordered-mat" role="tabpanel" aria-labelledby="mat-tab">
                <!-- course add space-->
                <div class="row  mt-3">
                  <div class="col-10">
                    <ul class="list-group list-group-flush">
                      <?php
                      $sql = "SELECT id, title, start_datetime, end_datetime, activity FROM ( select agn_id as id, agn_name as title, agn_start_date as 
                  start_datetime, agn_end_date as end_datetime, 'assignment' as activity from assignment, course_teacher where 
                  assignment.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}'                                        
                  union
                   select lm_id as id, lm_name as title, lm_upload_date_time as start_datetime, null, 'LM' as activity from learning_material,
                    course_teacher where learning_material.cse_id = course_teacher.cse_id and tchr_id = '{$_SESSION['userid']}'
                    union
                     SELECT id, title, start_datetime, end_datetime, 'schedule' as activity FROM schedule_list) as combine_table where start_datetime 
                     BETWEEN '" . date('Y-m-d H:i:s', time() - (86000 * 25)) . "' and  '" . date('Y-m-d H:i:s', time() + (86000 * 25)) . "'  limit 30";

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
            </div>
          </div>
        </div>


      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits"> -->
  <!-- All the links in the footer should remain intact. -->
  <!-- You can delete the links only if you purchased the pro version. -->
  <!-- Licensing information: https://bootstrapmade.com/license/ -->
  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
  <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
  <!-- </div> -->
  </footer><!-- End Footer -->

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


  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>