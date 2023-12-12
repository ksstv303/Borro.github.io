<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            margin-bottom: 20px;
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

    </style>
</head>

<header>

<img src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.15752-9/363524469_709676087771605_495796483082519635_n.png?_nc_cat=106&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeF1VluKgQuZfs9UeFQwMOrb2iIQbMMytV_aIhBswzK1X-2swCdmY2hnUUuQGkEve6LNfzfHfzq5ro7_MYtbgeEM&_nc_ohc=U_0XfA4KQ18AX_E6dCD&_nc_ht=scontent.fbkk5-8.fna&oh=03_AdR-uSHu0sa5hw-pvLZQ8oLrk79EhJZE7aHp4miMbF5rtw&oe=659BBFAF" alt="Logo" style="max-width: 15%; height: auto;"><br>
    <h4>ระบบการยืม - คืนรถส่วนกลางภายในสถานศึกษาวิทยาลัยการอาชีพบางสะพาน</h4> 
        

</header>

<div class="sidebar">
    <a href="Admin_Page.php">หน้าหลัก</a>
    <a href="add_car.php">เพิ่มรถ</a>
    <a href="borrow_form.php">เบิกรถ</a>
    <a href="report.php">รายงาน</a>
    <a href="rental_history.php">ประวัติการยืม</a>
    <a href="profile.php">โปรไฟล์</a>
    <a href="return_form.php">คืนรถ</a>
    <a href="logout.php">ออกจากระบบ</a>
</div>

<body>

<div class="container mt-5">
    <form action="submit_borrow_request.php" method="post">
        <h3 class="mb-4">ยืมรถ</h3>

        <div class="mb-3">
            <label for="car_id" class="form-label">เลือกรถที่จะยืม:</label>
            <select name="car_id" id="car_id" class="form-select" required>
                <?php
                // Include the database configuration file
                require_once 'db_config.php';

                // Fetch available cars from the database
                $availableCarsSql = "SELECT * FROM cars WHERE status = 0";
                $availableCarsResult = $conn->query($availableCarsSql);

                while ($row = $availableCarsResult->fetch_assoc()) {
                    echo "<option value='" . $row['car_id'] . "'>" . $row['brand'] . " " . $row['model'] . " ทะเบียน: " . $row['plate_number'] . ", สี: " . $row['color'] . "" . "</option>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">กดจองรถ</button>
    </form>
</div>


</body>
</html>