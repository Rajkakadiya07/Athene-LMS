<?php
$sql = "SELECT * FROM assignment WHERE cse_id = " . $_SESSION['course']['cse_id'];
if ($result = mysqli_query($conn, $sql)) {
    if (!empty($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li class='list-group-item mb-3'><a href='../assignment/view_assignment.php?agnId={$row['agn_id']}' class='text-dark'><i class='ri-draft-fill h5 me-1 align-middle'></i>{$row['agn_name']}</a></li>";
        }
    } else {
        echo "<li class='list-group-item mb-3'>No assignments are added</li>";
    }
}