<?php
require_once "./TCPDF-main/tcpdf.php";
require_once "../connection.php";
header('Content-Type: application/pdf');
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type as PDF
header('Content-Type: application/pdf');

// Before sending the PDF data
ob_start();

$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Attendance Report');

// Add a page
$pdf->AddPage();

// Get table content from POST data

$tableContent = $_POST['tableContent'];


// Generate HTML table content
$tableContent = '<table border="1">
               <tr>
                   <th>Attendance Date</th>
                   <th>Attendance Time</th>
                   <th>Enrollment No.</th>
                   <th>Attendance Status</th>
               </tr>' . $tableContent . '</table>'; // Add received table content

// Add table content to PDF
$pdf->writeHTML($tableContent, true, false, true, false, '');

ob_end_clean();


// Output PDF as response
$pdf->Output('attendance_report.pdf', 'I');
?>
