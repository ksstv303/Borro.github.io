<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1em;
    margin-bottom: 20px;
}

.container {
    width: auto;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

input {
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #333;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}

p {
    color: red;
    margin-top: 10px;
}

/* Additional Styling */
/*body {
    background-color: #f9f9f9;
}

header img {
    max-width: 100%;
    height: auto;
}

h1 {
    margin-bottom: 10px;
    color: #333;
}

.container {
    width: 50%;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    max-width: 300px;
    margin: auto;
}

label {
    color: #555;
}

input[type="submit"] {
    background-color: #4CAF50;
}

input[type="submit"]:hover {
    background-color: #45a049;
}


        /* ... (โค้ด CSS อื่น ๆ) ... */
    </style>
</head>
<body>

<header>
    <img src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t39.30808-6/316522374_193732799805675_4327837573779836273_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=efb6e6&_nc_eui2=AeG5iHbGSubQMRScWp8BV-zjxi5XPGU8qvnGLlc8ZTyq-RtI_2O-3tBuRahOpcHqJPr6N53b2QweKjwfkUxe3uAC&_nc_ohc=8gb8GfVuOyIAX-hjH8T&_nc_ht=scontent.fbkk5-5.fna&oh=00_AfB5wU7rlISqFsApfkmHbzUWdPNsN6yn_VPLFG3VA_xLSA&oe=6574B78A" alt="Logo" style="max-width: 25%; height: auto;">
    <h3>ระบบการยืม - คืนรถส่วนกลางภายในสถานศึกษาวิทยาลัยการอาชีพบางสะพาน</h3>
</header>

<!-- ... (โค้ด HTML อื่น ๆ) ... -->

<div class="container mt-5">
    <div class ="row justify-content-center">
        <div calss = "col-md-6">
            <h4 class="mb-4">Register</h4>

            <?php
            // เชื่อมต่อกับฐานข้อมูล
           include 'db_config.php';

            // ตรวจสอบการส่งข้อมูลผ่านแบบ POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $position = $_POST['position'];
                $branch = $_POST['branch'];
                $phone_number = $_POST['phone_number'];
                $email = $_POST['email'];

            // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
            $check_duplicate = "SELECT * FROM users WHERE username = '$username'";
            $result_duplicate = $conn->query($check_duplicate);

            if ($result_duplicate->num_rows > 0) {
                echo "<script>
                    Swal.fire({
                        icon: 'Error',
                        title: 'ข้อผิดพลาด',
                        text: 'ชื่อผู้ใช้งานซ้ำ กรุณาลองใหม่อีกครั้ง!'
                    });
                </script>";
    } else {
        $passwordenc = md5($password);
        // Insert ข้อมูลในกรณที่มีข้อมูลไม่ซ้ำ 
        $insert_user = "INSERT INTO users (username, password, first_name, last_name, position, branch, phone_number, email)
                        VALUES ('$username', '$passwordenc', '$first_name', '$last_name', '$position', '$branch', '$phone_number', '$email')";

        if ($conn->query($insert_user) === TRUE) {
            echo "<script>
            Swal.fire({
                icon: 'Success',
                title: 'เรียบร้อยแล้ว',
                text: 'ลงทะเบียนสำเร็จ!'
            }).then(function() {
                window.location.href = 'login.php';
            });
            </script>";
            
        }else {
            echo "Error : ". $insert_user . "<br>" . $conn->error;
            // $registration_error = "เกิดข้อผิดพลาดในการสมัครสมาชิก";
        }
    } 
}
// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
        <form method="post" action="">
                <label for="username" class="form-label" >Username:</label>
                <input type="text" class="form-control" name="username" placeholder="Username" required>

                <label for="password" class="form-label" >รหัสผ่าน:</label>
                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" required>

                <label for="first_name" class="form-label">ชื่อจริง:</label>
                <input type="text" class="form-control" name="first_name" placeholder="ชื่อจริง" required>
            
                <label for="last_name" class="form-label">นามสกุล:</label>
                <input type="text" class="form-control" name="last_name" placeholder="นามสกุล" required>
            
                <label for="position" class="form-label">ตำแหน่ง:</label>
                <input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" required>

                <label for="branch" class="form-label">สาขางาน:</label>
                <select name="branch" class="form-select" required>
                    <option value="สาขาคอมพิวเตอร์ธุรกิจ">สาขาคอมพิวเตอร์ธุรกิจ</option>
                    <option value="สาขาช่างไฟฟ้ากำลัง">สาขาช่างไฟฟ้ากำลัง</option>
                    <option value="สาขาช่างอิเล็กทรอนิก">สาขาช่างอิเล็กทรอนิก</option>
                    <option value="สาขาช่างเชื่อมโลหะ">สาขาช่างเชื่อมโลหะ</option>
                    <option value="สาขาช่างยนต์">สาขาช่างยนต์</option>
                    <option value="สาขาช่างกลโรงงาน">สาขาช่างกลโรงงาน</option>
                    <option value="สาขาบัญชี">สาขาบัญชี</option>
                    <option value="สาขาการโรงแรม">สาขาการโรงแรม</option>
                    <option value="สาขาโลจิสติกส์">สาขาโลจิสติกส์</option>
                    <option value="สาขาสามัญสัมพันธ์">สาขาสามัญสัมพันธ์</option>
                    <option value="สาขาสามัญสัมพันธ์">พนักงานขับรถ</option>
                </select>

                <label for="phone_number" class="form-label" >เบอร์โทร:</label>
                <input type="text" class="form-control" name="phone_number" placeholder="เบอร์โทร" required>


                <label for="email" class="form-label" >อีเมล:</label>
                <input type="email" class="form-control" name="email" placeholder="อีเมล" required>

                
                <button type="submit" class="btn btn-primary">สมัครสมาชิก</button></a>
        </form>

        <?php
    // แสดงข้อความผิดพลาด (ถ้ามี)
    if (isset($registration_error)) {
        echo '<p style="color: red;">' . $registration_error . '</p>';
    }
    ?>
</div>
</body>
</html>