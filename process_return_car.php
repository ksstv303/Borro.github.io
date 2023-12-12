<?php
require_once 'db_config.php';
require_once 'line_notify.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['car_id'])) {
    $carId = $_POST['car_id'];

    // Update the status of the car to 'available' and delete borrow request record
    $updateCarStatusSql = "UPDATE cars SET status = 0 WHERE car_id = '$carId'";
    $conn->query($updateCarStatusSql);

    // Get the current date and time
    $returnDate = date('Y-m-d H:i:s');

    // Update the return date in the borrow_requests table
    $updateReturnDateSql = "UPDATE borrow_requests SET return_date = '$returnDate' WHERE car_id = '$carId'";
    $conn->query($updateReturnDateSql);

    $deleteBorrowRequestSql = "DELETE FROM borrow_requests WHERE car_id = '$carId'";
    $conn->query($deleteBorrowRequestSql);

    // Redirect back to the return page
    header("Location: return_page.php");
    exit();
} else {
    echo "Invalid request";
}

$conn->close();
?>