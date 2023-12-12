<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $requestId = $_GET['request_id'];

    // Update status in borrow_requests table to indicate approval
    $updateRequestStatusSql = "UPDATE borrow_requests SET status = 'approved' WHERE request_id = '$requestId'";
    $conn->query($updateRequestStatusSql);

    // Get car_id associated with the request
    $getCarIdSql = "SELECT car_id FROM borrow_requests WHERE request_id = '$requestId'";
    $carIdResult = $conn->query($getCarIdSql);
    $carIdRow = $carIdResult->fetch_assoc();
    $carId = $carIdRow['car_id'];

    // Update status in cars table to indicate the car is borrowed (status = 1)
    $updateCarStatusSql = "UPDATE cars SET status = 1 WHERE car_id = '$carId'";
    $conn->query($updateCarStatusSql);

    // Redirect back to the admin borrow requests page
    header("Location: admin_borrow_requests.php");
    exit();
}
?>