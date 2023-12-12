<!-- add_car_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Form</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">

    <!-- Add custom styles for better appearance -->
    <style>
        body {
            
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: auto;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #343a40;
        }

        form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        .sidebar {
            width: 200px;
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

        

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        img.logo {
            max-width: 15%;
            height: auto;
        }
        
        
        
        

    </style>
</head>

<header>


    
        <img src="" alt="">

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



</header>

<body>
        
        

<form action="process_add_car.php" method="post">
    <h2>ระบบเพิ่มรถของวิทยาลัยการอาชีพบางสะพาน</h2><br>

    <label for="brand">ยี้ห้อ:</label>
    <input type="text" name="brand" placeholder="ยี้ห้อ"required>

    <label for="model">รุ่น:</label>
    <input type="text" name="model" placeholder="รุ่นรถ"required>

    <label for="year">ปีผลิต:</label>
    <input type="number" name="year" placeholder="ปีผลิด" required>

    <label for="plate_number">ทะเบียนรถ:</label>
    <input type="text" name="plate_number" placeholder="ทะเบียนรถ" required>

    <label for="color">สีรถ:</label>
    <input type="text" name="color" placeholder="สีรถ" required>

    <button type="submit">เพิ่มรถ</button>
</form>

</body>
</html>
