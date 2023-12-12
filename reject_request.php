<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $requestId = $_GET['request_id'];

    // Update status in borrow_requests table to indicate rejection
    $updateRequestStatusSql = "UPDATE borrow_requests SET status = 'rejected' WHERE request_id = '$requestId'";
    $conn->query($updateRequestStatusSql);

    // Redirect back to the admin borrow requests page
    header("Location: admin_borrow_requests.php");
    exit();
}
?>