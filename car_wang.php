<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 25;
            top: 0;
            left: 0;
            background-color: #111;
            padding-top: 20px;
            padding-right: 10px;
            color: white;
        }

        #sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        #container {
            margin: 20px auto;
            margin-left: 220px;
            padding: 0px;
        }
1
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table,
        td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        thead {
            background-color: #273746;
            color: #fff;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #CFE0EB;
        }

        .btn-borrow {
            background-color: #FF0000;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-return {
            background-color: #00CC00;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="sidebar">
    <a href="user_page.php" onclick="loadContent('user_page.php')">หน้าหลัก</a>
    <a href="car_wang.php" onclick="loadContent('car_wang.php')">รถที่ว่าง</a>
    <a href="test.php" onclick="loadContent('test.php')">รายงาน</a>
    <a href="logout.php">ออกจากระบบ</a>
</div>

<?php
    require_once 'db_config.php';

    $availableCarsSql = "SELECT * FROM cars WHERE car_id NOT IN (SELECT car_id FROM borrowed_cars)";
    $availableCarsResult = $conn->query($availableCarsSql);
    $conn->close();
?>

<div id ="container">
    <h2>รายการรถ</h2>
    <table>
        <thead>
            <tr>
                <td width="5%">รหัสรถ</td>
                <td width="20%">ยี่ห้อ</td> 
                <td width="20%">รุ่น</td>
                <td width="20%">ปี</td> 
                <td width="10%">สถานะ</td>
            </tr> 
        </thead>
        <tbody>
            <?php while($row = $availableCarsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['car_id']; ?></td>
                    <td><?php echo $row['brand']; ?></td>
                    <td><?php echo $row['model']; ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td>
                        <button class="btn-borrow" onclick="borrowCar( . $row['car_id'] . ')">ยืม</button>
                        <button class="btn-return" onclick="returnCar( . $row['car_id'] . ')">คืน</button>
                    </td>
            </tr>
            <?php endwhile ?>
        </tbody>
</table>
</div>
<script>
    function borrowCar(carId) {
        // ตรวจสอบว่ารถนั้นๆ ยังไม่ถูกยืม
        // ถ้ายังไม่ถูกยืมให้ทำการยืม
        // และทำการอัพเดทตาราง borrowed_cars
        // ถ้ายังไม่ถูกยืม
        // (ตรวจสอบจาก PHP ด้วย AJAX)
        $.post("check_borrowed_status.php", { car_id: carId }, function(data) {
            if (data === 'available') {
                // ถ้ายังไม่ถูกยืม
                // ทำการยืม (ส่งข้อมูลไปยังไฟล์ PHP ที่จัดการการยืมรถ)
                $.post("borrow_car.php", { car_id: carId }, function(response) {
                    console.log(response);
                    // ทำการอัพเดทหน้าเว็บหรือทำอย่างอื่นตามต้องการ
                });
            } else {
                // ถ้าถูกยืมแล้ว
                console.log('Car already borrowed');
                // ทำอย่างอื่นตามต้องการ (แสดงข้อความ หรือทำอย่างอื่น)
            }
        });
    }

    function returnCar(carId) {
        // ตรวจสอบว่ารถนั้นๆ ถูกยืม
        // ถ้าถูกยืมให้ทำการคืน
        // และทำการอัพเดทตาราง returns และ borrowed_cars
        // (ตรวจสอบจาก PHP ด้วย AJAX)
        $.post("check_borrowed_status.php", { car_id: carId }, function(data) {
            if (data === 'borrowed') {
                // ถ้าถูกยืม
                // ทำการคืน (ส่งข้อมูลไปยังไฟล์ PHP ที่จัดการการคืนรถ)
                $.post("return_car.php", { car_id: carId }, function(response) {
                    console.log(response);
                    // ทำการอัพเดทหน้าเว็บหรือทำอย่างอื่นตามต้องการ
                });
            } else {
                // ถ้ายังไม่ถูกยืม
                console.log('Car not borrowed');
                // ทำอย่างอื่นตามต้องการ (แสดงข้อความ หรือทำอย่างอื่น)
            }
        });
    }
</script>
</body> 
</html>