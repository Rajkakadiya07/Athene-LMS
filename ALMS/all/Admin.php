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
require_once "../sidebar.php";
require_once "../header.php";
 ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./Admin.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="./Admin.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>

    <div class="col-12 ">
      <div class="card m-1">
        <div class="card-body">
          <img src="../assets/img/profile-img.jpg" style="width:80px;width:80px;" alt="Profile" class="rounded-circle mt-4">
          <span class="h5 text-dark">&nbsp;&nbsp;&nbsp;&nbsp;ADMIN | Raj Kakadiya</span>

        </div>

      </div>

    </div>
    <div class="row row-cols-1 ">
      <div class="col-3 ">
        <div class="card  mt-3">

          <div class="card-body">
            <h5 class="card-title text-center text-danger"><i class="ri-account-circle-fill h1"></i><br>Pending Requests Teachers</h5>
            <p class="h1 text-center " style="color:#012970;">5</p>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card mt-3">

          <div class="card-body">
            <h5 class="card-title text-center text-success"><i class="ri-account-circle-fill h1"></i><br>Total Teachers</h5><br>
            <p class="h1 text-center" style="color:#012970;">50</p>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card mt-3">

          <div class="card-body">
            <h5 class="card-title text-center"><i class="ri-account-circle-fill h1"></i><br>Pending Requests Students</h5>
            <p class="h1 text-center" style="color:#012970;">10</p>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="card mt-3 ">

          <div class="card-body">
            <h5 class="card-title text-center text-success"><i class="ri-account-circle-fill h1"></i><br>Total Students</h5><br>



            <p class="h1 text-center" style="color:#012970;">250</p>
          </div>
        </div>
      </div>

    </div>
    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title">Course</h5> -->

        <!-- Bordered Tabs -->
        <ul class=" mt-3 nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="mat-tab" data-bs-toggle="tab" data-bs-target="#bordered-mat" type="button" role="tab" aria-controls="mat" aria-selected="true"><i class="ri-book-read-fill h5"></i> Recent Activity</button>
          </li>
        </ul>
        <div class="tab-content pt-2" id="borderedTabContent">
          <div class="tab-pane fade show active" id="bordered-mat" role="tabpanel" aria-labelledby="mat-tab">
            <!-- course add space-->
            <div class="col-8 mt-2">
              <div class="card-body">
                <span class="h6 text-dark"><a href="#" class="text-dark"><i class="ri-discuss-fill h5"></i> Announcements</a></span>
              </div>
            </div>
            <div class="row  mt-3">
              <div class="col-10">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-book-read-fill h5"></i> HTML 5 pdf</a></li>
                  <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-draft-fill h5"></i> Quiz 2</a></li>
                  <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-book-read-fill h5"></i> NodeJs Notes</a></li>
                  <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-clipboard-fill h5"></i> Assaignment 3 </a></li>
                  <li class="list-group-item mb-3"><a href="#" class="text-dark"><i class="ri-file-list-2-fill h5"></i>Practical 1 </a></li>
                  <hr>
                </ul>
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
    </div>
    </div>


  </main><!-- End #main -->
  <!-- <div class="col-lg-12">
          <div class="row pe-3">
    

            
          </div>
        </div> -->

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
  <script>
    $(document).ready(function() {

      $(".edit").click(function() {
        $('#edit').modal('show');
      });
    });
  </script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
<!-- <div class='col-12'>
              <div class='card recent-sales overflow-auto'>

                <div class='filter'>
                  <a class='icon' href="#" data-bs-toggle='dropdown'><i class='bi bi-three-dots'></i></a>
                  <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow'>
                    <li class='dropdown-header text-start'>
                      <h6>Filter</h6>
                    </li>

                    <li><a class='dropdown-item' href='#'>Today</a></li>
                    <li><a class='dropdown-item' href='#'>This Month</a></li>
                    <li><a class='dropdown-item' href='#'>This Year</a></li>
                  </ul>
                </div>

                <div class='card-body'>
                  <h5 class='card-title'>Recent Students <span>| Today</span></h5>

                  <table class='table table-borderless datatable' id='myTable'>
                    <thead>
                      <tr>
                        <th>Enroll No</th>
                        <th scope='col'>FullName</th>
                        <th scope='col'>Email</th>

                        <th scope='col'>Course</th>
                        <th scope='col'>Action</th>
                      </tr>

                    </thead>
                    <tbody>

                      <td>202103100110141
                      <div class="collapse" id="collapseExample">
                        <div class="card  mt-2">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                          style="border-radius: 1rem;" 
                        </div>
                      </div>
                      </td>
                      <td>Raj Kakadiya  
                        <div class="collapse" id="collapseExample">
                        <div class="card mt-2">
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                      </div>
                    </td>
                      <td>rajkakadiya@gmail.com
                      <div class="collapse" id="collapseExample">
                      <div class="card mt-2">
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                      </div>
                      </td>
                      <td>BCA
                      <div class="collapse" id="collapseExample">
                      <div class="card mt-2">
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                      </div>
                      </td>
                      <td>

                      <button type='button' data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class='Edit btn btn-primary btn-sm m-1'>Edit</button>
      
                      <button type='button' class='edit btn btn-primary btn-sm m-1'>Approve</button>
                      <button type='button' class='delete btn btn-primary btn-sm m-1'>Reject</button>
                      <div class="collapse" id="collapseExample">
                        <div class="card mt-2">
                        <button type='button'  class='submit btn btn-primary btn-sm'>Submit</button>
                        </div>
                      </div>
                    </td>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->