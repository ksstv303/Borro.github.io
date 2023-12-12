<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Car</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #007bff;
        }

        h4 {
            color: white;
        }

        label {
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            margin-bottom: 20px;
        }


    </style>
</head>

<header>

<img src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.15752-9/363524469_709676087771605_495796483082519635_n.png?_nc_cat=106&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeF1VluKgQuZfs9UeFQwMOrb2iIQbMMytV_aIhBswzK1X-2swCdmY2hnUUuQGkEve6LNfzfHfzq5ro7_MYtbgeEM&_nc_ohc=U_0XfA4KQ18AX_E6dCD&_nc_ht=scontent.fbkk5-8.fna&oh=03_AdR-uSHu0sa5hw-pvLZQ8oLrk79EhJZE7aHp4miMbF5rtw&oe=659BBFAF" alt="Logo" style="max-width: 25%; height: auto;"><br>
    <h4>ระบบการยืม - คืนรถส่วนกลางภายในสถานศึกษาวิทยาลัยการอาชีพบางสะพาน</h4> 
        

</header>

<body>

<div class="container mt-5">
    <form action="process_return_car.php" method="post">
        <h3 class="mb-4">คืนรถ</h3>
        <label for="car_id" class="form-label">เลือกรถที่จะคืน:</label>
        <select name="car_id" id="car_id" class="form-select" required>
            <?php
            // Include the database configuration file
            require_once 'db_config.php';

            // Fetch borrowed cars from the database
            $borrowedCarsSql = "SELECT br.car_id, c.plate_number, c.color, c.brand, c.model, u.username, u.first_name, u.last_name
                                    FROM borrow_requests br
                                    JOIN cars c ON br.car_id = c.car_id
                                    JOIN users u ON br.username = u.username
                                    WHERE br.status = 'approved'";

            $borrowedCarsResult = $conn->query($borrowedCarsSql);

            while ($row = $borrowedCarsResult->fetch_assoc()) {
                echo "<option value='" . $row['car_id'] . "'>" . $row['username'] . " " . $row['first_name'] . " " . $row['last_name'] . " - " . $row['brand'] . " " . $row['model'] . " - ทะเบียน: " . $row['plate_number'] . " - สี: " . $row['color'] . "</option>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </select>
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary">กดคืนรถ</button>
        </div>
    </form>
</div>

</body>
</html>