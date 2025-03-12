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
  <!-- Normalize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <!-- Cropper CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
  <!-- Cropper JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    .page {
      margin: 1em auto;
      max-width: 768px;
      display: flex;
      align-items: flex-start;
      flex-wrap: wrap;
      height: 100%;
    }

    .box {
      padding: 0.5em;
      width: 100%;
      margin: 0.5em;
    }

    .box-2 {
      padding: 0.5em;
      width: calc(100%/2 - 1em);
    }

    .options label,
    .options input {
      width: 4em;
      padding: 0.5em 1em;
    }

    .hide {
      display: none;
    }

    img {
      max-width: 100%;
    }
    body {
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 0;
}

/* Add your existing styles here */

/* Media query for small screens (up to 767px) */
@media (max-width: 767px) {
    /* Modify styles for small screens */
    .col-xl-4,
    .col-xl-8 {
        width: 100%;
    }

    #profile-image {
        width: 80px;
        height: 80px;
    }

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
    /* Modify styles for medium screens */
    .col-xl-4,
    .col-xl-8 {
        width: 50%;
    }

    /* Add more specific styles for medium screens if needed */
}
/* Media query for small screens (up to 767px) */
@media (max-width: 767px) {
    /* Modify styles for small screens */
    .col-md-8,
    .col-lg-9 {
        width: 100%;
    }

    .col-2 {
        width: 100%;
        margin-bottom: 5px; /* Add margin between labels and input fields */
    }

    .col-8 {
        width: 100%;
    }
}


/* Media query for large screens (992px and above) */
@media (min-width: 992px) {
    /* Modify styles for large screens */
    .col-xl-4 {
        width: 33.3333%;
    }

    .col-xl-8 {
        width: 66.6666%;
    }

    /* Add more specific styles for large screens if needed */
}


  </style>

</head>



<?php
global $data;
session_start();

$_SESSION['username'];
$name = $_SESSION['userid'];
require_once "../connection.php";


require_once "../sidebar.php";
require_once "../header.php";
?>

<main id="main" class="main">
  <?php
  $query = null;
  if ($_SESSION['usertype'] == "Admin") {
    $query = "select adm_name as 'uname', adm_email as 'uemail', adm_contact_no as 'ucontact', adm_profile_image as image" .
      " from admin where adm_id = '{$_SESSION['userid']}'";
  } else if ($_SESSION['usertype'] == "Teacher") {
    $query = "select tchr_name as uname, tchr_contact_no as ucontact, tchr_email as uemail, tchr_gender as ugender, tchr_profile_image as image " .
      "from teacher where tchr_id = '{$_SESSION['userid']}'";
  } else if ($_SESSION['usertype'] == "Student") {
    $query = "select stud_name as uname, stud_contact_no as ucontact, stud_email as uemail, stud_gender as ugender, stud_semester, stud_profile_image as image " .
      "from student where stud_id = '{$_SESSION['userid']}'";
  }

  if (!empty($query)) {
    if ($result = mysqli_query($conn, $query)) {
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
      }
    }
  }
  ?>


  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img id="profile-image" style="width: 100px; height: 100px; margin-bottom:10px" class="rounded-circle"
              src="" alt="Profile Image">
            <h4 class="text-dark">
              <?php echo $_SESSION['userid']; ?>
            </h4>
            <h3 class="text-dark">
              <?php echo $_SESSION['usertype']; ?>
            </h3>
            <div class="text-success " id="messageDiv"></div>
          </div>
        </div>
      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab"
                  data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 text-dark">Name</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="name-data">
                    <div class="col-lg-3 col-md-4 text-dark">
                      <?= $data['uname'] ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 text-dark">Contact</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="contact-data">
                    <div class="col-lg-3 col-md-4 text-dark">
                      <?= $data['ucontact'] ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 text-dark">Email</div>
                  <div class="col-lg-9 col-md-8 text-dark" id="email-data">
                    <?= $data['uemail'] ?>
                  </div>
                </div>
                <?php
                if ($_SESSION['usertype'] != "Admin") {
                  ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 text-dark">Gender</div>
                    <div class="col-lg-9 col-md-8 text-dark" id="gender-data">
                      <?php echo ($data['ugender'] == 'm') ? "Male" : "Female"; ?>
                    </div>
                  </div>
                  <?php
                }

                if ($_SESSION['usertype'] == "Student") {
                  ?>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 text-dark">Semester</div>
                    <div class="col-lg-9 col-md-8 text-dark" id="sem-data">
                      <?php
                      echo $data['stud_semester'];
                      ?>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>

              <?php
              if ($_SESSION['usertype'] == "Admin") {
                $query = "select adm_name as 'uname', adm_email as 'uemail', adm_contact_no as 'ucontact', adm_profile_image as image" .
                  " from admin where adm_id = '{$_SESSION['userid']}'";
              } else if ($_SESSION['usertype'] == "Teacher") {
                $query = "select tchr_name as uname, tchr_contact_no as ucontact, tchr_email as uemail, tchr_gender as ugender, tchr_profile_image as image " .
                  "from teacher where tchr_id = '{$_SESSION['userid']}'";
              } else if ($_SESSION['usertype'] == "Student") {
                $query = "select stud_name as uname, stud_contact_no as ucontact, stud_email as uemail, stud_gender as ugender, stud_semester, stud_profile_image as image " .
                  "from student where stud_id = '{$_SESSION['userid']}'";
              }

              if (!empty($query)) {
                if ($result = mysqli_query($conn, $query)) {
                  if ($result->num_rows > 0) {
                    $data1 = $result->fetch_assoc();
                  }
                }
              }
              ?>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <form id="profileEditForm" method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="fullName" class="col-2 col-form-label text-dark">Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="name"
                        value="<?php echo $data1['uname'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="contact" class="col-2 col-form-label text-dark">Contact</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="contact" type="text" class="form-control" id="contact"
                        value="<?php echo $data1['ucontact'] ?>">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="email" class="col-2 col-form-label text-dark">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email"
                        value="<?php echo $data1['uemail'] ?>">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-2">

                    </div>
                    <div class="col-8">
                      <button id="updateUserData" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </div>
                </form>
                <div class="">
                  <div class="row mb-3">

                    <main class="page">
                      <div class="box">
                        <p class="text-dark">Choose profile picture</p>
                        <input type="file" class="form-control form-control-sm" id="file-input">
                      </div>
                      <!-- leftbox -->
                      <div class="box-2">
                        <div class="result"></div>
                      </div>
                      <!--rightbox-->
                      <div class="box-2 img-result hide">
                        <!-- result of crop -->
                        <img class="cropped" src="" alt="">
                      </div>
                      <!-- input file -->
                      <div class="box" class="display:none">
                        <div class="options hide">
                          <label> Width</label>
                          <input type="number" class="img-w" value="300" min="100" max="1200" />
                        </div>
                        <!-- save btn -->
                        <button type="button" id="uploadImage" class="btn btn-primary save hide">Upload</button>
                      </div>
                    </main>
                  </div>
                </div>
              </div>



              <div class="tab-pane fade pt-3" id="profile-change-password">

                <form id="passwordChangeForm" method="post">


                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label  text-dark">Current
                      Password</label>
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
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label  text-dark">Re-enter New
                      Password</label>
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


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>


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
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>




<script>

  // vars
  let result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    img_w = document.querySelector('.img-w'),
    img_h = document.querySelector('.img-h'),
    options = document.querySelector('.options'),
    save = document.querySelector('#uploadImage'),
    cropped = document.querySelector('#profile-image'),
    upload = document.querySelector('#file-input'),
    cropper = '';

  // img_h.setAttribute("display","none");

    // on change show image with crop options
    upload.addEventListener('change', e => {
      if (e.target.files.length) {
        // start file reader
        const reader = new FileReader();
        reader.onload = e => {
          if (e.target.result) {
            // create new image
            let img = document.createElement('img');
            img.id = 'image';
            img.src = e.target.result;
            // clean result before
            result.innerHTML = '';
            // append new image
            result.appendChild(img);
            // show save btn and options
            save.classList.remove('hide');
            // options.classList.remove('hide');
            // init cropper
            cropper = new Cropper(img, {
              aspectRatio: 1, // 1:1 aspect ratio
              viewMode: 2,
              movable: false,
              rotatable: false,
              scalable: false,
              zoomable: false
            });
          }
        };
        reader.readAsDataURL(e.target.files[0]);
      }
    });

    save.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent the default form submission behavior

      // get result to data uri
      let imgSrc = cropper.getCroppedCanvas({
        width: img_w.value // input value
      }).toDataURL();
      // remove hide class of img
      // cropped.classList.remove('hide');
      img_result.classList.remove('hide');
      // show image cropped
      cropped.src = imgSrc;
      // Create a new Blob from the imgSrc
      const blob = dataURItoBlob(imgSrc);
      // Create a FormData object
      const formData = new FormData();
      formData.append('profileImage', blob, 'image.png');

      $.ajax({
        type: "POST",
        url: "./update_user_image.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Handle the success response here
          console.log("Image uploaded successfully");
          // Reload the page or perform any necessary actions
          setTimeout(window.location.reload(), 1000);
        },
        error: function (xhr) {
          // Handle errors here
          console.error("Error uploading image");
        },
      });
    });



  // Function to convert data URI to Blob
  function dataURItoBlob(dataURI) {
    const byteString = atob(dataURI.split(',')[1]);
    const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    const ab = new ArrayBuffer(byteString.length);
    const ia = new Uint8Array(ab);
    for (let i = 0; i < byteString.length; i++) {
      ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], { type: mimeString });
  }

  $(document).ready(function () {
    updateUserDetails();

    function updateUserDetails() {
      $.ajax({
        url: "get_user_profile_image.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          // console.log(data);

          if (data.error) {
            console.error("Error: " + data.error);
            $("#messageDiv").html("Error: " + data.error);
            return;
          }

          var usertype = data[0].usertype;
          // console.log(data[0].image_path);
          // console.log(data[0].image_path === "null");
          if (data[0].image_path !== "null" && data[0].image_path !== "") {
            var imageSrc = data[0].image_path;
            $("#profile-image").attr("src", imageSrc);
          } else {
            $("#profile-image").attr("src", "../assets/img/blank-profile.jpg");
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
            setTimeout(function () {
              $("#messageDiv").html("");
            }, 10000);
          }
        },
      });
    });

    $("#profileEditForm").submit(function (event) {
      event.preventDefault();

      var formData = new FormData(this);
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "update_profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response === "success") {
            $("#messageDiv").html("Profile updated");
            hideSuccessMessage();
          } else {
            $("#messageDiv").html(response);
            setTimeout(function () {
              $("#messageDiv").html("");
            }, 10000);
          }
        },
      });
    });
  });

</script>

<?php require_once "../js.php" ?>
    
</body>

</html>