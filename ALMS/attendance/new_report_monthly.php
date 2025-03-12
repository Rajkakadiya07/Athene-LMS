<!DOCTYPE html>
<html lang="en">
<?php
extract($_POST);
?>

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


    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .card {
            margin-top: 40px;
        }


        .table-container {
            height: 400px;
            overflow-y: auto;
        }

        .fixed-header {
            position: sticky;
            top: 0;
            background-color: #1d1d1d;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border: 1px solid black;
        }
        /* Default styles for the table */
.text-dark {
    display: flex;
    justify-content: center;
    align-items: center;
}

#myTable {
    width: 100%;
    margin-top: 20px;
}

#myTable th,
#myTable td {
    padding: 10px;
    text-align: center;
}

/* Styles for Medium Screens (Tablets) */
@media (max-width: 991px) {
    #myTable th,
    #myTable td {
        font-size: 12px;
    }
}

/* Styles for Small Screens (Mobile Phones) */
@media (max-width: 767px) {
    #myTable th,
    #myTable td {
        font-size: 10px;
    }
}

    </style>
</head>


<body>

    <?php
    session_start();
    require_once("../header.php");
    require_once("../sidebar.php");
    require("../connection.php");
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
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">
                    <h5 class="card-title">Attedance Report Monthly</h5>

                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Report</button>
                        </li>
                    </ul>

                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row">
                                <div class=" col-12 mb-4">
                             
                                        <div class="">

                                            <?php
                                            require_once "../connection.php";
                                            $sql = "SELECT stu.stud_id, att_date, TIME_FORMAT(att_time, '%r') as att_time, (CASE WHEN att_status = 1 THEN 'P' ELSE 'A' END) AS presentORabsent
                        FROM attendance att, student stu, category cat, course cou
                        WHERE  cou.cse_id = $reportCourse 
                        AND cat.cat_id = cou.cat_id
                        AND att.cse_id = cou.cse_id
                        AND DATE(att_date) BETWEEN  " . date('Ymd', strtotime($reportStartDate)) . " AND  " . date('Ymd', strtotime($reportEndDate)) .
                                                " AND att.stud_id = stu.stud_id order by att_date asc, TIME_FORMAT(att_time, '%r') desc;";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {
                                                echo "<div class='text-dark'style='display:flex; justify-content:center; align-items:center;'><table class='table-responsive' id='myTable' style='width:100;'>
                                            <thead style='color:white;'class='fixed-header'>
                                            <tr>
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                        <th>Enrollment No.</th>
                        <th>Attendance Status</th>
                    </tr>
                    </thead>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                        <td>{$row['att_date']}</td>
                        <td>{$row['att_time']}</td>";
                                                    if ($row['presentORabsent'] == "P") {
                                                        echo "<td style='background-color:rgba(0,255,0,0.1);'>{$row['stud_id']}</td><td style='background-color:rgba(0,255,0,0.1);'>{$row['presentORabsent']}</td>";
                                                    } else {
                                                        echo "<td style='background-color:rgba(255,0,0,0.1);'>{$row['stud_id']}</td><td style='background-color:rgba(255,0,0,0.1);'>{$row['presentORabsent']}</td>";
                                                    }
                                                    echo "</tr>";
                                                }
                                                echo "</table></div>";
                                            } else {
                                                echo "<h6 class='text-center'>No results found</h6>";
                                            }
                                            ?>
                                        </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>


    <script src="../assets/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('#pdfForm').on('submit', function (event) {
                event.preventDefault();

                var tableContent = $('#myTable').html();

                $.ajax({
                    url: 'generate_pdf.php',
                    type: 'POST',
                    data: {
                        tableContent: tableContent
                    },
                    success: function (response) {
                        // Check if the response is a valid PDF header
                        if (response.startsWith('%PDF-1.7')) {
                            // Create a Blob from the PDF data
                            var blob = new Blob([response], { type: 'application/pdf' });
                            console.log('Table Content:', tableContent);

                            // Create a temporary anchor element and trigger the download
                            var url = window.URL.createObjectURL(blob);
                            var a = document.createElement('a');
                            a.href = url;
                            a.download = 'attendance_report.pdf';
                            document.body.appendChild(a);
                            a.click();

                            // Clean up
                            window.URL.revokeObjectURL(url);
                        } else {
                            console.error('Invalid PDF response:', response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error generating PDF:', error);
                    }
                });
            });
        });

    </script>

</body>

</html>