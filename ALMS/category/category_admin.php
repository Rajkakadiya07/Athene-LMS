<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Athene LMS</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php include "../css.php"; ?>
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
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
</head>

<body>
    <?php
    session_start();
    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

    <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-error-warning-line text-primary h2"></i>
                        <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                        <p class="mt-2 text-dark" id="modalCourseName"></p>
                        <button type="button" class="btn btn-secondary my-2 close">Close</button>
                        <a class="icon" id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2" data-dismiss="modal">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Category</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">View Category</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Configure Category</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">


                            <?php
                            $sql = "SELECT * FROM category";
                            $result = mysqli_query($conn, $sql);
                            if (!empty($result->num_rows) && $result->num_rows > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($i % 2 == 1) {
                                        echo "<div class='row mt-3'>";
                                    }

                                    echo "
                                    <div class='col-lg-6 col-md-6 col-sm-12 mb-3'>
                                    <div class='card card-hover'>
                                        <div class='filter'></div>
                                        <div class='row no-gutters'>
                                            <div class='col-3 col-sm-2'>
                                                <i class='bi bi-journal-text text-dark' style='font-size:100px;padding-left:20px;'></i>
                                            </div>
                                            <div class='col-12 col-sm-7'>
                                                <div class='card-body'>
                                                    <h5 class='card-title'></h5>
                                                    <h5 class='place-card__content_header ms-2'>
                                                        <a href='../course/course_admin.php?cat_id={$row['cat_id']}'><p class='text-primary place-title'>{$row['cat_short_name']}</p></a>
                                                        <p class='text-muted d-block text-truncate'>{$row['cat_full_name']}</p>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class='col-12 col-sm-3 text-center'>
                                                <div class='d-flex flex-row-reverse justify-content-between mt-2 '>
                                                    <a href='#' class='icon' data-bs-toggle='dropdown'><i class='bi bi-three-dots-vertical h5 text-dark'></i></a>
                                                    <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow'>
                                                        <li><a class='dropdown-item' href='category_edit.php?catId={$row['cat_id']}&catFullName={$row['cat_full_name']}&catShortName={$row['cat_short_name']}'>Edit</a></li>
                                                        <li><a class='dropdown-item del' link='category_db.php?deleteCategory={$row['cat_id']}' short='{$row['cat_short_name']}' full='{$row['cat_full_name']}'>Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                 ";

                                    if ($i % 2 == 0) {
                                        echo "</div>";
                                    }
                                    $i++;
                                }
                            } else {
                                echo "<h6 class='text-secondary my-3 text-center'>No categories are available</h6>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="col-xl-12 mt-3">
                                <form id="createCategory" action="category_db.php" method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="row mb-3">
                                                <label class="col-md-2 col-form-label text-dark" for="shortname">Category Short Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="shortname" name="shortname" placeholder="Enter Category Short Name">
                                                    <p class="invalid" id="categoryShortName"></p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-2 col-form-label text-dark" for="fullname">Category
                                                    Full Name</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Category Full Name">
                                                    <p class="invalid" id="categoryFullName"></p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <input type="submit" name="insertForm" class="btn btn-primary" value="Add Category">
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
        <!-- End  Tab -->

        </div>
    </main>

    <!-- Vendor JS Files -->
    <!-- <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script> -->
    <?php include "../js.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script>
        $(document).ready(function() {
            //Form validation
            form = document.querySelector("#createCategory");
            $(form).on('submit', function verifyform(event) {
                event.preventDefault();
                shortname = document.getElementById('shortname').value;
                fullname = document.getElementById('fullname').value;

                if (fullname == "" && shortname == "") {
                    $('#categoryShortName').show();
                    $('#categoryShortName').html("Please enter a short name");
                    $('#categoryFullName').show();
                    $('#categoryFullName').html("Please enter a full name");
                    return false;
                } else if (shortname == "") {
                    $('#categoryShortName').show();
                    $('#categoryShortName').html("Please enter a short name");
                    return false;
                } else if (fullname == "") {
                    $('#categoryFullName').show();
                    $('#categoryFullName').html("Please enter a full name");
                    return false;
                }
                form.submit();
            });


            $('.del').click(function(e) {
                $('#mod1').modal('show');
                catName = $(e.target).attr('full') + " (" + $(e.target).attr('short') + ")";
                link = $(e.target).attr('link');
                console.log(catName + link);
                $("#modalCourseName").html(catName);
                $("#modalDeleteBtn").attr("href", link);

            });

            $('.close').click(function() {
                $('#mod1').modal('hide');
            });


            // Remove warnings after altered inputs

            $('input').on('input', function(e) {
                if (e.target.id == "shortname") {
                    $('#categoryShortName').hide();
                } else if (e.target.id == "fullname") {
                    $('#categoryFullName').hide();
                }
            });

        });
    </script>
</body>


</html>