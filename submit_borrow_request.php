<?php
require_once 'db_config.php';
require_once 'line_notify.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Insert the borrow request into the borrow_requests table
    $insertRequestSql = "INSERT INTO borrow_requests (car_id, username, first_name, last_name) 
                        VALUES ('$car_id', '$username', '$first_name', '$last_name')";
    
    if ($conn->query($insertRequestSql) === TRUE) {
        // Update the status of the car to 'pending'
        $updateCarStatusSql = "UPDATE cars SET status = 1 WHERE car_id = '$car_id'";
        $conn->query($updateCarStatusSql);

        // Get car details
        $getCarDetailsSql = "SELECT * FROM cars WHERE car_id = '$car_id'";
        $carResult = $conn->query($getCarDetailsSql);
        $carData = $carResult->fetch_assoc();

        // Notify Line about the borrowed car
        $message = "รถที่มีทะเบียน " . $carData['plate_number'] . " ถูกยืมโดย " . $username;
        sendLineNotify($message);

        // Display success message
        echo "ยืมรถสำเร็จและแจ้งเตือนผ่าน Line Notify";
    } else {
        echo "Error submitting request: " . $conn->error;
    }

    $conn->close();
}
?>