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

</head>

<?php
session_start();
$_SESSION['username'];
$name = $_SESSION['userid'];

if ($_SESSION['usertype'] == "Admin") {
  require_once '../admin/header_admin.php';
  require_once '../admin/sidebar_admin.php';
} else if ($_SESSION['usertype'] == "Teacher") {
  require_once '../teacher/header_teacher.php';
  require_once '../teacher/sidebar_teacher.php';
} else if ($_SESSION['usertype'] == "Student") {
  require_once '../student/header_student.php';
  require_once '../student/sidebar_student.php';
  require_once "../connection.php";
}

?>

<main id="main" class="main">



  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img id="profile-image" style="width: 200px; height: 100px;" class="rounded-circle" src="" alt="Profile Image">
             <h2 class="text-dark"><?php echo $_SESSION['userid']; ?>
            <h2 class="text-dark"><?php echo $_SESSION['username']; ?></h2>
            <h3 class="text-dark"><?php echo $_SESSION['usertype']; ?></h3>
            <div class="text-success " id="messageDiv"></div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label text-dark">Name</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="name-data">
                   
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label text-dark">Contact</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="contact-data">
           
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label text-dark">Email</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="email-data">
                    
                  </div>
                </div>
              </div>


              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form id="profileEditForm" method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label text-dark">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="profileImage" type="file" class="form-control-file" accept="image/*" id="profileImage">
                      <img id="imagePreview" src="" alt="Image Preview" style="display: none;" class="rounded-circle">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label text-dark">Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="name">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="contact" class="col-md-4 col-lg-3 col-form-label text-dark">Contact</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="contact" type="text" class="form-control" id="contact">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label text-dark">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>

              </div>
              <div class="tab-pane fade pt-3" id="profile-change-password">

                <form id="passwordChangeForm" method="post">


                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label  text-dark">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label text-dark">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label  text-dark">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form>

              </div>

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>


</main>


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="../validation/js/form_validation.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>




<script>
  $('.button').click(function() {
    var buttonId = $(this).attr('id');
    $('#modal-container').removeAttr('class').addClass(buttonId);
    $('body').addClass('modal-active');
  })

  $('#modal-container').click(function() {
    $(this).addClass('out');
    $('body').removeClass('modal-active');
  });
</script>
<script>
$(document).ready(function() {
  function updateUserDetails() {
  $.ajax({
    url: "get_user_data.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data); 

      if (data.error) {
        console.error("Error: " + data.error);
        $("#messageDiv").html("Error: " + data.error);
        return;
      }

      var usertype = data[0].usertype;

      switch (usertype) {
        case "Admin":
          $("#name-data").text(data[0].adm_name);
          $("#contact-data").text(data[0].adm_contact_no);
          $("#email-data").text(data[0].adm_email);
          
          break;
        case "Teacher":
          $("#name-data").text(data[0].tchr_name);
          $("#contact-data").text(data[0].tchr_contact_no);
          $("#email-data").text(data[0].tchr_email);
          break;
        case "Student":
          $("#name-data").text(data[0].stud_name);
          $("#contact-data").text(data[0].stud_contact_no);
          $("#email-data").text(data[0].stud_email);
          break;
        default:
          console.error("Invalid user type: " + usertype);
          break;
      }
      if (data[0].image_path) {
        var imageSrc = "../profile/" + data[0].image_path;
        $("#profile-image").attr("src", imageSrc);
      }
    },
    error: function (xhr) {
      $("#messageDiv").html(
        'Request Status: ' +
          xhr.status +
          ' Status Text: ' +
          xhr.statusText +
          ' ' +
          xhr.responseText
      );
    },
  });
}

$(document).ready(function () {
  updateUserDetails();
});

$(".btn-primary").click(function () {
  updateUserDetails();
});

function hideSuccessMessage() {
  $("#messageDiv").fadeOut(3000); 
}

$("#passwordChangeForm").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "change_password.php",
      data: formData,
      success: function (response) {
        if (response === "success") {
          $("#messageDiv").html("Password changed successfully!");
          hideSuccessMessage(); 
        } else {
          $("#messageDiv").html(response);
        }
      },
    });
  });

    $("#profileEditForm").submit(function(event) {
      event.preventDefault();

      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "update_profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if (response === "success") {
            alert("Profile updated successfully!");

          } else {
            $("#messageDiv").html(response);
          }
        },
      });
    });
  });
</script>



</body>

</html>