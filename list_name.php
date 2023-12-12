<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- เพิ่มสไตล์ CSS ตามต้องการ -->
    <style>
        /* ... (สไตล์ CSS ตามต้องการ) ... */
    </style>
</head>
<body>

<!-- เพิ่มส่วนของหัวเว็บไซต์หรือเมนูตามต้องการ -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>User List</h2>

            <?php
            // เชื่อมต่อกับฐานข้อมูล
            require_once 'db_config.php';

            // คำสั่ง SQL เพื่อดึงข้อมูลผู้ใช้ทั้งหมด
            $userListSql = "SELECT * FROM borrowed_cars";
            $userListResult = $conn->query($userListSql);

            if ($userListResult->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead><tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Branch</th></tr></thead>';
                echo '<tbody>';
                while ($user = $userListResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $user['username'] . '</td>';
                    echo '<td>' . $user['first_name'] . '</td>';
                    echo '<td>' . $user['last_name'] . '</td>';
                    echo '<td>' . $user['position'] . '</td>';
                    echo '<td>' . $user['branch'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'ไม่มีข้อมูลผู้ใช้';
            }

            // ปิดการเชื่อมต่อกับฐานข้อมูล
            $conn->close();
            ?>
        </div>
    </div>
</div>

</body>
</html>
