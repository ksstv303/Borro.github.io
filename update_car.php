<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'db_config.php';

// ตรวจสอบว่ามีการส่งไอดีรถมาหรือไม่
if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // ดึงข้อมูลรถจากฐานข้อมูล
    $query = "SELECT * FROM cars WHERE id = $car_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลรถ";
        exit;
    }
} else {
    echo "ไม่ได้ระบุรถที่ต้องการแก้ไข";
    exit;
}

// ตรวจสอบการส่งค่าแก้ไขรถ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $status = $_POST['status'];
    $image = $_POST['image'];

    // อัปเดตข้อมูลรถในฐานข้อมูล
    $update_query = "UPDATE cars SET brand = '$brand', model = '$model', year = '$year', color = '$color', status = '$status', image = '$image' WHERE id = $car_id";

    if ($conn->query($update_query) === TRUE) {
        echo "อัปเดตข้อมูลรถสำเร็จ";
        // ทำการ redirect หลังจากอัปเดตข้อมูล
        header("Location: admin_cars.php");
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูลรถ: " . $conn->error;
    }
}

// ตรวจสอบการส่งค่าลบรถ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_car'])) {
    // ลบข้อมูลรถในฐานข้อมูล
    $delete_query = "DELETE FROM cars WHERE id = $car_id";

    if ($conn->query($delete_query) === TRUE) {
        echo "ลบข้อมูลรถสำเร็จ";
        // ทำการ redirect หลังจากลบข้อมูล
        header("Location: admin_cars.php");
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูลรถ: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - จัดการรถ</title>
    <!-- ... (CSS code) ... -->
</head>
<body>

<header>
    <h1>Admin Dashboard - จัดการรถ</h1>
</header>

<div class="sidebar">
    <a href="Admin_Page.php">หน้าหลัก</a>
    <a href="car.php">จัดการรถ</a>
    <a href="report.php">รายงาน</a>
    <a href="#">ออกจากระบบ</a>
</div>

<div class="container">
    <h2>รายการรถ</h2>

    <!-- เพิ่มรหัสนี้ในตารางของคุณ -->
    <form method="post" action="">
        <label for="brand">Brand:</label>
        <input type="text" name="brand" value="<?php echo $car['brand']; ?>" required><br>

        <label for="model">Model:</label>
        <input type="text" name="model" value="<?php echo $car['model']; ?>" required><br>

        <label for="year">Year:</label>
        <input type="text" name="year" value="<?php echo $car['year']; ?>" required><br>

        <label for="color">Color:</label>
        <input type="text" name="color" value="<?php echo $car['color']; ?>" required><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="ว่าง" <?php echo ($car['status'] == 'ว่าง') ? 'selected' : ''; ?>>ว่าง</option>
            <option value="ไม่ว่าง" <?php echo ($car['status'] == 'ไม่ว่าง') ? 'selected' : ''; ?>>ไม่ว่าง</option>
        </select><br>

        <label for="image">Image URL:</label>
        <input type="text" name="image" value="<?php echo $car['image']; ?>" required><br>

        <input type="submit" name="update_car" value="อัปเดตข้อมูลรถ">
        <input type="submit" name="delete_car" value="ลบรถ">
    </form>

    <a href="add_car.php" class="add-button">เพิ่มรถ</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ยี่ห้อ</th>
                <th>รุ่น</th>
                <th>ปี</th>
                <th>สถานะ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <!-- ใส่ข้อมูลรถที่ดึงมาจากฐานข้อมูลที่เก็บรถ -->
            <tr>
                <td><?php echo $car['id']; ?></td>
                <td><?php echo $car['brand']; ?></td>
                <td><?php echo $car['model']; ?></td>
                <td><?php echo $car['year']; ?></td>
                <td><?php echo $car['status']; ?></td>
                <td>
                    <a href="#" class="edit-button">แก้ไข</a>
                    <a href="#" class="delete-button">ลบ</a>
                </td>
            </tr>
            <!-- เพิ่มแถวตามจำนวนรถที่มี -->
        </tbody>
    </table>
</div>

</body>
</html>
