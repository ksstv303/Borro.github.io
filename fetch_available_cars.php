<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'db_config.php';

// คำสั่ง SQL สำหรับดึงรถที่สามารถยืมได้
$sql = "SELECT * FROM cars WHERE car_id NOT IN (SELECT car_id FROM borrowed_cars)";
$result = $conn->query($sql);

// สร้าง dropdown list
$dropdown = "<option value=''>Select a car</option>";
while ($row = $result->fetch_assoc()) {
    $dropdown .= "<option value='{$row['car_id']}'>{$row['brand']} - {$row['model']}</option>";
}

echo $dropdown;

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
