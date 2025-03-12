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
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }

    /* Inside your <style> tag or CSS file */

/* Default icon size */
.card-icon {
    font-size: 5em; /* Adjust the font-size to control the icon size */
    width: 100px; /* Adjust the width of the icon element */
    height: 100px; /* Adjust the height of the icon element */
    padding-left: 1em; /* Adjust the left padding for spacing */
}

/* Media query for small screens (phones) */
@media (max-width: 576px) {
    .card-icon {
        font-size: 3em; /* Decrease the font-size for smaller screens */
        width: 10px; /* Decrease the width for smaller screens */
        height: 10px; /* Decrease the height for smaller screens */
        padding-left: 0.5em; /* Adjust the left padding for spacing on small screens */
    }
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

        /* Default styles */

        /* Add your default styles here */

        /* Media queries for responsiveness */

        /* Small devices (phones) */
        @media (max-width: 576px) {
            .col-6 {
                flex: 0 0 100%;
                /* Make the column take full width on small screens */
                max-width: 100%;
                /* Ensure the card doesn't overflow */
                margin-bottom: 15px;
                /* Add some bottom margin for spacing */
            }

            .col-3 {
                flex: 0 0 30%;
                /* Adjust the width of the left column (icon) */
                max-width: 30%;
            }

            .col-8 {
                flex: 0 0 70%;
                /* Adjust the width of the right column (content) */
                max-width: 70%;
            }
        }

        /* Medium devices (tablets) */
        @media (min-width: 577px) and (max-width: 991px) {
            /* Adjust styles for medium devices if needed */
        }

        /* Large devices (desktops) */
        @media (min-width: 992px) and (max-width: 1199px) {
            /* Adjust styles for large devices if needed */
        }

        /* Extra large devices (large desktops) */
        @media (min-width: 1200px) {
            /* Adjust styles for extra large devices if needed */
        }
    </style>
</head>

<body>
    <?php

    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>

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
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- course add space-->
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
                                <div class='col-6'>
                                <div class='card'>
                                  <div class='filter'>
                                    
                                  </div>
                                    <div class='row no-gutters'>
                                        <div class='col-3'>
                                         <i class='bi bi-journal-text text-dark' style='font-size:100px;padding-left:20px;'></i>
                                        </div>
                                        <div class='col-8'>
                                            <div class='card-body'>
                                                <h5 class='card-title'></h5>
                                                <h5 class='place-card__content_header ms-2'>
                                                    <a href='../course/course_teacher.php?cat_id={$row['cat_id']}'><p class='text-primary place-title'>{$row['cat_short_name']}</p></a>
                                                </h5>
                                                <p><span class='ms-2 text-muted d-block text-truncate'>{$row['cat_full_name']}</span></p>
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
                </div>
            </div>
        </div>
        <!-- End  Tab -->

        </div>
    </main>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

</body>
<?php require_once "../js.php" ?>

</html>