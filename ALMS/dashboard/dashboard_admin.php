<?php
session_start();
require_once "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Athene LMS</title>
    <?php require_once "../css.php" ?>

    <style>
        body {
            overflow-x: hidden;
        }

        a {
            cursor: pointer;
        }

        p {
            padding-bottom: 1rem;
        }

        h5 {
            font-weight: bold;
            color: #2b2b2b;
        }

        .card:hover {
            transform: scale(1.10);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            z-index: 1;
            transition: 300ms;
        }

        @media (max-width: 767px) {
            .col-3 {
                width: 100%;
                float: none;
            }
        }
        </style>

</head>

<body>
    <?php
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>


    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="../dashboard/dashboard_admin.php">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-3 ">
                <a href="../user_registration/user_reg_selection.php">
                    <div class="card  mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-danger text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Pending Requests Teachers</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                $sql = "select count(*) as count from pending_requests where usr_type = 'teacher'";
                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
            <a href="../user_registration/user_reg_selection.php">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-success text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Registered Teachers</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                // $sql = "select count(*) as count from pending_requests where usr_type = 'teacher'";
                                $sql = "select count(*) as count from teacher";

                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
            <a href="../user_registration/user_reg_selection.php">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Pending requests students</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                $sql = "select count(*) as count from pending_requests where usr_type = 'student'";

                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                </a>
            </div>
        </div>
        <div class="col-3">
        <a href="../user_registration/user_reg_selection.php">
                <div class="card mt-3 ">
                    <div class="card-body">
                        <h5 class="card-title text-center text-success text-nowrap"><i
                                class="ri-account-circle-fill h1"></i><br>Registered Students</h5>



                        <p class="h1 text-center" style="color:#012970;">
                            <?php
                            $sql = "select count(*) as count from student";
                            if ($result = mysqli_query($conn, $sql)) {
                                if ($result->num_rows == 1) {
                                    $row = $result->fetch_assoc();
                                    echo $row['count'];
                                }
                            } else {
                                echo "0";
                            }

                            ?>
                        </p>
                    </div>
                </div>
            </a>
        </div>

        </div>
        <div class="row">
            <div class="col-3">
            <a href="../user_registration/user_reg_selection.php">
                    <div class="card  mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-danger text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Categories</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                $sql = "select count(*) as count from category";
                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-3">
            <a href="../user_registration/user_reg_selection.php">
                    <div class="card  mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-success text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Courses</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                $sql = "select count(*) as count from course";
                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-3">
            <a href="../user_registration/user_reg_selection.php">
                    <div class="card  mt-3">
                        <div class="card-body">
                            <h5 class="card-title text-center text-nowrap"><i
                                    class="ri-account-circle-fill h1"></i><br>Activities</h5>
                            <p class="h1 text-center " style="color:#012970;">
                                <?php
                                $sql = "
                            SELECT COUNT(*) AS count FROM 
                            ( SELECT agn_id FROM assignment
                              UNION
                              SELECT lm_id FROM learning_material
                              UNION 
                              SELECT qui_id FROM quiz 
                            ) AS combined_table;
                            ";
                                if ($result = mysqli_query($conn, $sql)) {
                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();
                                        echo $row['count'];
                                    }
                                } else {
                                    echo "0";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
            </div>
        </div>

    </main>

    <?php require_once "../js.php" ?>


</body>

</html>