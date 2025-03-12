<?php
 date_default_timezone_set("Asia/Kolkata");
//  echo date("d-m-Y h:i:s A", time()); 

 echo date("d-m-Y\TH:i", strtotime("2023-04-15 09:45:00"));
 echo "<input type='datetime-local' class='form-control' id='course_title' name='totMarks' value='" . date("Y-m-d\TH:i", strtotime("2023-04-15 09:45:00")) . "'>";
 
 
 ?>
