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
        .box {
            color: #fff;
            padding: 20px;
            display: none;
            margin-top: 20px;
        }
  
        .red {
            background: red;
        }
  
        .green {
            background: green;
        }
  
        .blue {
            background: blue;
        }
    </style>
    <!--importing jquery cdn-->
    <script src=
"https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
  
    <script>
        // jQuery functions to hide and show the div
        $(document).ready(function () {
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
        });
    </script>
</head>


<body>


    <main id="main" class="main ps-0">
    <div>
        <!--dropdown list options-->
        <select class="form-control">
            <option>Choose Color</option>
            <option value="material">Add Material</option>
            <option value="quiz">Quiz</option>
            <option value="assign">Assaignment</option>
            <option value="other">Others</option>

        </select>
    </div>
    <!--divs that hide and show-->
    <div class="material for">
    <div class="col-xl-12 mt-3">
              <form>
                <div class="row justify-content-center">
                  <div class="col-xl-8">
                  <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description"> Name</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Assignment Name">
                      </div>
                    </div>                 
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Description</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Description">
                      </div>
                    </div>  
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Start Date</label>
                      <div class="col-md-10">
                        <input type="date" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">End Date</label>
                      <div class="col-md-10">
                        <input type="date" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Upload File</label>
                      <div class="col-md-10">
                        <input type="file" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <br>
                    <div class="text-center">
                      <button type="reset" class="btn btn-secondary">Discard</button>&nbsp;&nbsp;
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
    </div>
    <div class="quiz for"> <div class="col-xl-12 mt-3">
              <form>
                <div class="row justify-content-center">
                  <div class="col-xl-8">
                  <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description"> Name</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Quiz Name">
                      </div>
                    </div>  
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Description</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Description">
                      </div>
                    </div>       
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Marks</label>
                      <div class="col-md-10 mt-2">
                        <input type="number" class="form-control" id="course_title" name="title" placeholder="Enter Total Marks">
                      </div>
                    </div>                
                   
                    <!-- <br><br><br> -->
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Start Time</label>
                      <div class="col-md-10">
                        <input type="time" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">End Time</label>
                      <div class="col-md-10">
                        <input type="time" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
               
                    <br>
                    <div class="text-center">
                      <button type="reset" class="btn btn-secondary">Discard</button>&nbsp;&nbsp;
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
    </div>
</div>
    <div class="assign for">
    <form>
                <div class="row justify-content-center">
                  <div class="col-xl-8">
                  <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description"> Name</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Quiz Name">
                      </div>
                    </div>  
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Description</label>
                      <div class="col-md-10 mt-2">
                        <input type="text" class="form-control" id="course_title" name="title" placeholder="Enter Description">
                      </div>
                    </div>       
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Marks</label>
                      <div class="col-md-10 mt-2">
                        <input type="number" class="form-control" id="course_title" name="title" placeholder="Enter Total Marks">
                      </div>
                    </div>                
                   
                    <!-- <br><br><br> -->
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Start Time</label>
                      <div class="col-md-10">
                        <input type="time" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">End Time</label>
                      <div class="col-md-10">
                        <input type="time" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-2 col-form-label text-dark" for="short_description">Upload File</label>
                      <div class="col-md-10">
                        <input type="file" class="form-control" id="course_title" name="title">
                      </div>
                    </div>
               
                    <br>
                    <div class="text-center">
                      <button type="reset" class="btn btn-secondary">Discard</button>&nbsp;&nbsp;
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </div>
                </div>
              </form>
    </div>
    <div class="other for">Selected</div>
    </main>





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
    <!-- <script>
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
    </script> -->
    <script type="text/javascript"></script>
<script src="jquery-ui-1.10.0/ui/jquery-ui.js"></script>
<script>    
$('#dbType').change(function(){

   selection = $('this').value();
   switch(selection)
   {
       case 'other':
           $('#otherType').show();
           break;
       case 'default':
           $('#otherType').hide();
           break;
   }
});
</script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>
<section class="section dashboard">


    <!-- Left side columns -->