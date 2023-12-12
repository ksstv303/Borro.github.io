<!-- process_return.php -->

<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $borrowedId = $_POST['borrowed_id'];

    // SQL เพื่อเพิ่มข้อมูลการคืนรถลงใน returns และลบข้อมูลจาก borrowed_cars
    $returnSql = "INSERT INTO returns (borrowed_id, user_id, first_name, last_name, branch) 
                  SELECT borrowed_id, user_id, first_name, last_name, branch FROM borrowed_cars WHERE borrowed_id = '$borrowedId';";

    $deleteBorrowSql = "UPDATE FROM borrowed_cars WHERE borrowed_id = '$borrowedId'";

    if ($conn->query($returnSql) === TRUE && $conn->query($deleteBorrowSql) === TRUE) {
        echo 'Car returned successfully';
    } else {
        echo 'Error returning car: ' . $conn->error;
    }
} else {
    echo 'Invalid request';
}

$conn->close();
?>
