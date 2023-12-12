<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
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

        .container {
            padding: 20px;
        }

        h2 {
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
    </style>
</head>
<body>

<header>
    <img src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.15752-9/363524469_709676087771605_495796483082519635_n.png?_nc_cat=106&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeF1VluKgQuZfs9UeFQwMOrb2iIQbMMytV_aIhBswzK1X-2swCdmY2hnUUuQGkEve6LNfzfHfzq5ro7_MYtbgeEM&_nc_ohc=U_0XfA4KQ18AX_E6dCD&_nc_ht=scontent.fbkk5-8.fna&oh=03_AdR-uSHu0sa5hw-pvLZQ8oLrk79EhJZE7aHp4miMbF5rtw&oe=659BBFAF" alt="Logo" style="max-width: 15%; height: auto;"><br>
    <h1>Admin Report</h1>
</header>

<div class="container">
    <h2>รายงานการยืมรถ</h2>
    <?php
    require_once 'db_config.php';

    // คำสั่ง SQL เพื่อดึงข้อมูลการยืมรถ
    $sql = "SELECT * FROM borrow_requests";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Request ID</th><th>User ID</th><th>Car ID</th><th>Borrow Date</th><th>Return Date</th><th>Status</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['request_id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['car_id'] . '</td>';
            echo '<td>' . $row['request_date'] . '</td>';
            echo '<td>' . $row['return_date'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'ไม่มีข้อมูลการยืมรถ';
    }

    $conn->close();
    ?>
</div>

</body>
</html>