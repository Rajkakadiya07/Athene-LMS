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
</head>


<body>
<?php
include 'header.php';
include 'ssidebar.php';
?>
  <main id="main" class="main">
  <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./stud.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="./stud.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>

    <div class="row">
      <div class="card ps-1 col-11 m-1 ">

        <div class="card-body">
          <h5 class="card-title">Course</h5>

          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">View Courses</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Configure course</button>
          </li> -->


          </ul>
          <div class="tab-content pt-2" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
              <!-- course add space-->
              <div class="row  mt-3">
              <div class="col-6 ">
                  <div class="place-card">
                    <div class="place-card__img">
                      <img src="./16.jpg" class="place-card__img-thumbnail" alt="Thumbnail">
                    </div>
                    <div class="place-card__content mt-2  ">
                      <h5 class="place-card__content_header"><a href="#!" class="text-dark place-title" >BCA  | OOPS    <i class="bi bi-book"></i></a></h5>
                      <p><span class="text-muted">object oriented programming</p>
      
                    </div>
                  </div>
                </div>
                <div class="col-6 ">
                  <div class="place-card">
                    <div class="place-card__img">
                      <img src="./16.jpg" class="place-card__img-thumbnail" alt="Thumbnail">
                    </div>
                    <div class="place-card__content mt-2 ">
                    <h5 class="place-card__content_header"><a href="#!" class="text-dark place-title" >BCA  | AI    <i class="bi bi-book"></i></a></h5>
                      <p><span class="text-muted">Artificial intelligence</span></p>

                    </div>
                  </div>
                </div>
                <div class="col-6 ">
                  <div class="place-card">
                    <div class="place-card__img">
                      <img src="./16.jpg" class="place-card__img-thumbnail" alt="Thumbnail">
                    </div>
                    <div class="place-card__content mt-2 ">
                    <h5 class="place-card__content_header"><a href="./sicourse.php" class="text-dark place-title" >BCA   | AWD    <i class="bi bi-book"></i></a></h5>
                   <p><span class="text-muted">Advacne Web Design</span></p>

                    </div>
                  </div>
                </div>
                <div class="col-6 ">
                  <div class="place-card">
                    <div class="place-card__img">
                      <img src="./16.jpg" class="place-card__img-thumbnail" alt="Thumbnail">
                    </div>
                    <div class="place-card__content mt-2 ">
                    <h5 class="place-card__content_header"><a href="#!" class="text-dark place-title" >BCA   | PC    <i class="bi bi-book"></i></a></h5>
                      <p><span class="text-muted">professional communication</span></p>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
    </div>



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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
<section class="section dashboard">


  <!-- Left side columns -->