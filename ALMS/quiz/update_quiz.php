<?php
require_once "../connection.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data (adjust these lines based on your form fields)
    $quizId = mysqli_real_escape_string($conn, $_POST['quizId']);
    $quizName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $quizDesc = mysqli_real_escape_string($conn, $_POST['contact']);
    $startTime = mysqli_real_escape_string($conn, $_POST['startTime']);
    $endTime = mysqli_real_escape_string($conn, $_POST['endTime']);

    // Perform the update operation in the database (adjust SQL query based on your table structure)
    $sql = "UPDATE quiz SET qui_name='$quizName', qui_desc='$quizDesc', qui_start_time='$startTime', qui_end_time='$endTime' WHERE qui_id=$quizId";

    if (mysqli_query($conn, $sql)) {
        // Update operation successful, prepare the response data
        $response = array(
            "status" => "success",
            "quizName" => $quizName,
            "quizDesc" => $quizDesc,
            "startTime" => $startTime,
            "endTime" => $endTime
        );
        // Send the JSON response back to the JavaScript code
        echo json_encode($response);
    } else {
        // Handle database update error
        $response = array(
            "status" => "error",
            "message" => "Error updating quiz: " . mysqli_error($conn)
        );
        echo json_encode($response);
    }

    // Close the database connection (if opened)
    mysqli_close($conn);
} else {
    // Handle invalid requests (if any)
    $response = array(
        "status" => "error",
        "message" => "Invalid request."
    );
    echo json_encode($response);
}
?>

