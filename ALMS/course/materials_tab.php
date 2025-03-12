<?php
$sql = "SELECT * FROM learning_material WHERE cse_id = " . $_SESSION['course']['cse_id'];
if ($result = mysqli_query($conn, $sql)) {
    if (!empty($result->num_rows) && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li class='list-group-item mb-3'><a href='../learning_material/view_materials.php?materialId={$row['lm_id']}' class='text-dark'><i class='ri-draft-fill h5 me-1 align-middle'></i>{$row['lm_name']}</a></li>";
        }
    } else {
        echo "<li class='list-group-item mb-3'>No materials are added</li>";
    }
}