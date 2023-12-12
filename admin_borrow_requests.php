<?php
require_once 'db_config.php';

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch pending borrow requests from the database
$pendingRequestsSql = "SELECT br.request_id, br.car_id, br.username, br.first_name, br.last_name, br.request_date, c.brand, c.model, c.plate_number, c.color
                       FROM borrow_requests br
                       JOIN cars c ON br.car_id = c.car_id
                       WHERE br.status = 'pending'";
$pendingRequestsResult = $conn->query($pendingRequestsSql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Borrow Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
        }

        .container {
            max-width: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #000;
        }

        .btn-action {
            white-space: nowrap;
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

<img src="https://scontent.fbkk5-8.fna.fbcdn.net/v/t1.15752-9/363524469_709676087771605_495796483082519635_n.png?_nc_cat=106&ccb=1-7&_nc_sid=8cd0a2&_nc_eui2=AeF1VluKgQuZfs9UeFQwMOrb2iIQbMMytV_aIhBswzK1X-2swCdmY2hnUUuQGkEve6LNfzfHfzq5ro7_MYtbgeEM&_nc_ohc=U_0XfA4KQ18AX_E6dCD&_nc_ht=scontent.fbkk5-8.fna&oh=03_AdR-uSHu0sa5hw-pvLZQ8oLrk79EhJZE7aHp4miMbF5rtw&oe=659BBFAF" alt="Logo" style="max-width: 10%; height: auto;"><br>
    <h3>ระบบการยืม - คืนรถส่วนกลางภายในสถานศึกษาวิทยาลัยการอาชีพบางสะพาน</h3> 
        

</header>
<body>


<div class="container mt-5">
    <h3>ตารางการอนุมัติยืมรถ</h3>
    <?php
    // Check if there are rows in the result set
    if ($pendingRequestsResult === false) {
        echo "Error executing query: " . $conn->error;
    } elseif ($pendingRequestsResult->num_rows > 0) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>รหัสยืมรถ</th>
                    <th>รหัสยืมรถ</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>ทะเบียนรถ</th>
                    <th>สีรถ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อจริง</th>
                    <th>นามสกุล</th>
                    <th>วัน-เวลาที่ขอ</th>
                    <th>การอนุมัติ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $pendingRequestsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['request_id']; ?></td>
                        <td><?php echo $row['car_id']; ?></td>
                        <td><?php echo $row['brand']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['plate_number']; ?></td>
                        <td><?php echo $row['color']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['request_date']; ?></td>
                        <td>
                            <a href="admin_approve.php?request_id=<?php echo $row['request_id']; ?>" class="btn btn-success">อนุมัติ</a>
                            <a href="reject_borrow_request.php?request_id=<?php echo $row['request_id']; ?>" class="btn btn-danger">ไม่อนุมัติ</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "ยังไม่มีกาจองรถ";
    }
    ?>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>