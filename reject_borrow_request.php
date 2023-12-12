<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Fetch the car_id associated with the rejected request
    $fetchCarIdSql = "SELECT car_id FROM borrow_requests WHERE request_id = '$request_id'";
    $result = $conn->query($fetchCarIdSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $car_id = $row['car_id'];

        // Update the status of the borrow request to 'rejected'
        $updateStatusSql = "UPDATE borrow_requests SET status = 'rejected' WHERE request_id = '$request_id'";

        if ($conn->query($updateStatusSql) === TRUE) {
            // Update the status of the car to 'available'
            $updateCarStatusSql = "UPDATE cars SET status = 0 WHERE car_id = '$car_id'";
            
            if ($conn->query($updateCarStatusSql) === TRUE) {
                header("Location: admin_borrow_requests.php");
                exit();
            } else {
                echo "Error updating car status: " . $conn->error;
            }
        } else {
            echo "Error rejecting request: " . $conn->error;
        }
    } else {
        echo "Car not found for the given request";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>