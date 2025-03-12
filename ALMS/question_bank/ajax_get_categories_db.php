<?php
require_once "../connection.php";
extract($_POST);

$sql = "select distinct ques_category from question where ques_category like '%" . $value . "%'";
if($value != ""){
$response = [];
if ($result = mysqli_query($conn, $sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc())
            $response[] = $row['ques_category'];
    }else{
        $response[] = 'No suggestions found';
    }
}
}
else{
    $response = ["Empty value"];
}
echo json_encode($response);
?>