<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Update the status of the borrow request to 'approved'
    $updateStatusSql = "UPDATE borrow_requests SET status = 'approved' WHERE request_id = '$request_id'";

    if ($conn->query($updateStatusSql) === TRUE) {
        // Get the details from the borrow request
        $getBorrowDetailsSql = "SELECT br.request_id, br.car_id, br.username, br.first_name, br.last_name, c.brand, c.model, c.plate_number, c.color
                               FROM borrow_requests br
                               JOIN cars c ON br.car_id = c.car_id
                               WHERE br.request_id = '$request_id'";

        $result = $conn->query($getBorrowDetailsSql);
        $row = $result->fetch_assoc();

        $car_id = $row['car_id'];

        // Update the status of the car to 'borrowed'
        $updateCarStatusSql = "UPDATE cars SET status = 1 WHERE car_id = '$car_id'";
        $conn->query($updateCarStatusSql);

        // Redirect to admin_borrow_requests.php with the updated details
        header("Location: admin_borrow_requests.php");
        exit();
    } else {
        echo "Error approving request: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>