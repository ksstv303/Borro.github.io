<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #ddd;
            color: #fff;
            padding: 10px;
            text-align: center;
            image-orientation: center;
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
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        td[status="0"] {
            background-color: #66cc66; /* สีแดง */
            color: #fff; /* สีข้อความ */
        }

        td[status="1"] {
            background-color: #ff6666; /* สีเขียว */
            color: #333; /* สีข้อความ */
        }


    </style>
</head>
<body>

<header>
    <img src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.15752-9/363524469_709676087771605_495796483082519635_n.png?_nc_cat=106&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeF1VluKgQuZfs9UeFQwMOrb2iIQbMMytV_aIhBswzK1X-2swCdmY2hnUUuQGkEve6LNfzfHfzq5ro7_MYtbgeEM&_nc_ohc=U_0XfA4KQ18AX_E6dCD&_nc_ht=scontent.fbkk5-8.fna&oh=03_AdR-uSHu0sa5hw-pvLZQ8oLrk79EhJZE7aHp4miMbF5rtw&oe=659BBFAF" alt="Logo" style="max-width: 10%; height: auto;"><br>
    <h1>Dashboard</h1>
</header>

<div class="sidebar">
    <a href="Admin_Page.php">หน้าหลัก</a>
    <a href="add_car.php">เพิ่มรถ</a>
    <a href="borrow_form.php">เบิกรถ</a>
    <a href="report.php">รายงาน</a>
    <a href="rental_history.php">ประวัติการยืม</a>
    <a href="admin_borrow_requests.php">อนุมัติรถ</a>
    <a href="profile.php">โปรไฟล์</a>
    <a href="return_page.php">คืนรถ</a>
    <a href="logout.php">ออกจากระบบ</a>
</div>

<div class="container">
    <h2>รถทั้งหมด</h2>
    <?php
    // เชื่อมต่อกับฐานข้อมูล
    require_once 'db_config.php';

    // คำสั่ง SQL เพื่อดึงข้อมูลรถทั้งหมด
    $sql = "SELECT * FROM cars";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ยี่ห้อ</th><th>รุ่น</th><th>ทะเบียนรถ</th><th>ปี</th><th>สีรถ</th><th>สถานะ</th></tr>';
        while ($row = $result->fetch_assoc()) {
            $status_text = ($row['status'] == 0) ? 'ว่าง' : 'ไม่ว่าง';
            echo '<tr>';
            echo '<td>' . $row['brand'] . '</td>';
            echo '<td>' . $row['model'] . '</td>';
            echo '<td>' . $row['plate_number'] . '</td>';
            echo '<td>' . $row['year'] . '</td>';
            echo '<td>' . $row['color'] . '</td>';
            echo '<td status="' . $row['status'] . '">' . $status_text . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'ไม่มีข้อมูลรถ';
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
    ?>
</div>

</body>
</html>
