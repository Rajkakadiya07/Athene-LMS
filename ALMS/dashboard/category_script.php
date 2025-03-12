<?php
// category_script.php
// Establish database connection
require_once "../connection.php";

// SQL query to count categories
$sql = "SELECT COUNT(*) AS count FROM category";

// Execute the query and fetch the result
$result = mysqli_query($conn, $sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['count']; // Echo the count of categories
} else {
    echo "0"; // Echo 0 if no categories found
}

// Close the database connection
mysqli_close($conn);
?>
