<!-- process_add_car.php -->
<?php
require_once 'db_config.php';
require_once 'line_notify.php';

// รับค่าจากฟอร์ม
$plateNumber = $_POST['plate_number'];
$brand = $_POST['brand'];
$model = $_POST['model'];
$year = $_POST['year'];
$color = $_POST['color']; // รับข้อมูลสีจากฟอร์ม

// คำสั่ง SQL เพื่อเพิ่มข้อมูลรถ ด้วย Prepared Statements
$insertCarSql = "INSERT INTO cars (plate_number, brand, model, color, year) VALUES (?, ?, ?, ?, ?)";

// เตรียมคำสั่ง SQL
$stmt = $conn->prepare($insertCarSql);

// ผูกค่าพารามิเตอร์
$stmt->bind_param("ssssi", $plateNumber, $brand, $model, $color, $year);

// ทำการเพิ่มข้อมูล
if ($stmt->execute()) {
    // บันทึกสำเร็จ
    echo "<script>alert('เพิ่มรถเสร็จแล้ว');</script>";
    // Redirect หลังจากบันทึกข้อมูล
    echo "<script>window.location.href = 'add_car.php';</script>";
} else {
    // มีข้อผิดพลาด
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
    // Redirect หลังจากเกิดข้อผิดพลาด
    echo "<script>window.location.href = 'add_car.php';</script>";
}


// ปิดการเชื่อมต่อฐานข้อมูล
$stmt->close();
$conn->close();
?>