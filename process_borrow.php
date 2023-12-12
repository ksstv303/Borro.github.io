<?php
// Start the session (if not started already)
session_start();

require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in (adjust the condition based on your authentication logic)
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $carId = $_POST['car_id'];
        $userId = $_SESSION['user_id'];

        // SQL to insert data into borrowed_cars
        $borrowSql = "INSERT INTO borrowed_cars (user_id, car_id) VALUES ('$userId', '$carId')";

        if ($conn->query($borrowSql) === TRUE) {
            echo 'Car borrowed successfully';
        } else {
            echo 'Error borrowing car: ' . $conn->error;
        }
    } else {
        echo 'User not logged in';  // Adjust the message based on your authentication logic
    }
} else {
    echo 'Invalid request';
}

$conn->close();
?>
