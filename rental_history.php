<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental History</title>
    <!-- เพิ่ม stylesheet หรือ CDN ที่จำเป็น -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            background-color: #2c3e50;
            position: fixed;
            top: 0;
            left: 0;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #3498db;
        }

        .container {
            margin-left: 250px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .return-btn {
            background-color: #333;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .return-btn:hover {
            background-color: #555;
        }
    </style>

    <script>
        function returnCar(carId) {
            // ใช้ confirm เพื่อขอยืนยันการคืนรถ
            var confirmation = confirm("คุณต้องการคืนรถหรือไม่?");
            
            if (confirmation) {
                // ถ้ายืนยัน ส่งรหัสรถไปยัง process_return.php
                window.location.href = 'process_return.php?car_id=' + carId;
            } else {
                // ถ้ายกเลิก ไม่ต้องทำอะไร
                console.log("ยกเลิกการคืนรถ");
            }
    }
    </script>


</head>
<body>

<header>
    <h1>Rental History</h1>
</header>

<div class="sidebar">
    <a href="Admin_Page.php">หน้าหลัก</a>
    <a href="add_car.php">เพิ่มรถ</a>
    <a href="borrow_car.php">เบิกรถ</a>
    <a href="report.php">รายงาน</a>
    <a href="rental_history.php">ประวัติการยืม</a>
    <a href="Profile.php">โปรไฟล์</a>
    <a href="logout.php">ออกจากระบบ</a>
</div>

<div class="container">
    <!-- แสดงรายการยืมรถ -->
    <?php
    require_once 'db_config.php';

    $sql = "SELECT * FROM borrowed_cars";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>รหัสรถ</th><th>รหัสผู้ใช้</th><th>วันที่ยืม</th><th>วันที่คืน</th><th>การจัดการ</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['car_id'] . '</td>';
            echo '<td>' . $row['user_id'] . '</td>';
            echo '<td>' . $row['borrow_date'] . '</td>';
            echo '<td>' . $row['return_date'] . '</td>';
            echo '<td><button class="return-btn" onclick="returnCar(' . $row['car_id'] . ')">คืนรถ</button></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'ไม่มีประวัติการยืมรถ';
    }

    $conn->close();
    ?>
</div>

<script>
    function returnCar(carId) {
        // ส่งรหัสรถไปยัง process_return.php
        window.location.href = 'process_return.php?car_id=' + carId;
    }
</script>

</body>
</html>
