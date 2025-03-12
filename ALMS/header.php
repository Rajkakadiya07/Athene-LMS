<?php
$conn = mysqli_connect("localhost", "root", "", "athene_lms");
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$table = strtolower($usertype);

switch ($usertype) {
    case "Admin":
        $id_column = "adm_id";
        $image_column = "adm_profile_image";
        break;
    case "Teacher":
        $id_column = "tchr_id";
        $image_column = "tchr_profile_image";
        break;
    case "Student":
        $id_column = "stud_id";
        $image_column = "stud_profile_image";
        break;
    default:
     
}

$query = "SELECT $image_column as image_path FROM $table WHERE $id_column = '$userid'";
$result = mysqli_query($conn, $query);
$image_path = $result->fetch_assoc()['image_path'];

if (empty($image_path) || $image_path == null) {
    // echo "Empty";
    $image_path = "../assets/img/blank-profile.jpg";
}else{
    // echo "$image_path";
}
if ($_SESSION['usertype'] == "Admin") {
    ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <!-- <img src="../assets/img/logo.png" alt=""> -->
                <span class="d-none d-lg-block">Athene LMS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= $image_path ?>" class="adminImage rounded-circle" alt="Profile">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $_SESSION['username']; ?>
                        </span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <img src="<?= $image_path ?>" class="adminImage rounded-circle" width="100px"
                                alt="Profile" style=" margin-bottom:10px;">
                            <h6>
                                <?php echo $_SESSION['username']; ?>
                            </h6>
                            <span>
                                <?php echo $_SESSION['usertype']; ?>
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../profile/user_profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->

            </ul>
        </nav>
        <!-- End Icons Navigation -->


    </header>
    <!-- End Header -->
    <?php
} else if ($_SESSION['usertype'] == "Teacher") {
    ?>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="d-flex align-items-center justify-content-between">
                <a href="#" class="logo d-flex align-items-center">
                    <!-- <img src="../assets/img/logo.png" alt=""> -->
                    <span class="d-none d-lg-block">Athene LMS</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
            <!-- End Logo -->

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="<?= $image_path ?>" class="teacherImage rounded-circle" alt="Profile"
                                class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $_SESSION['username']; ?>
                            </span>
                        </a>
                        <!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <img src="<?= $image_path ?>" width="100px" class="teacherImage rounded-circle"
                                    id="adminImage" alt="Profile">
                                <h6>
                                <?php echo $_SESSION['username']; ?>
                                </h6>
                                <span>
                                <?php echo $_SESSION['usertype']; ?>
                                </span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="../profile/user_profile.php">
                                    <i class="bi bi-person"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>

                        </ul>
                        <!-- End Profile Dropdown Items -->
                    </li>
                    <!-- End Profile Nav -->

                </ul>
            </nav>
            <!-- End Icons Navigation -->


        </header>
        <!-- End Header -->
    <?php
} else if ($_SESSION['usertype'] == "Student") {
    ?>
            <!-- ======= Header ======= -->
            <header id="header" class="header fixed-top d-flex align-items-center">

                <div class="d-flex align-items-center justify-content-between">
                    <a href="#" class="logo d-flex align-items-center">
                        <!-- <img src="../assets/img/logo.png" alt=""> -->
                        <span class="d-none d-lg-block">Athene LMS</span>
                    </a>
                    <i class="bi bi-list toggle-sidebar-btn"></i>
                </div>
                <!-- End Logo -->

                <nav class="header-nav ms-auto">
                    <ul class="d-flex align-items-center">

                        <li class="nav-item dropdown pe-3">

                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                                <img src="<?= $image_path ?>" class="studentImage rounded-circle" alt="Profile">

                                <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $_SESSION['username']; ?>
                                </span>
                            </a>
                            <!-- End Profile Iamge Icon -->

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header">
                                    <img src="<?= $image_path ?>" width="100px" class="studentImage rounded-circle"
                                        alt="Profile">
                                    <h6>
                                <?php echo $_SESSION['username']; ?>
                                    </h6>
                                    <span>
                                <?php echo $_SESSION['usertype']; ?>
                                    </span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="../profile/user_profile.php">
                                        <i class="bi bi-person"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>


                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- End Profile Dropdown Items -->
                        </li>
                        <!-- End Profile Nav -->

                    </ul>
                </nav>
                <!-- End Icons Navigation -->


            </header>
            <!-- End Header -->
    <?php
}