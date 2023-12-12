<?php
// เริ่ม session
session_start();

if (isset($_POST['$username'])) {

    // เชื่อมต่อกับฐานข้อมูล
    include 'db_config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordenc = md5($password);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$passwordenc'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1); 
    
        $row = mysqli_fetch_array($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user'] = $row['frist_name'] . " " . $row['last_name'];
        $_SESSION['is_admin'] = $row['is_admin'];

        if($_SESSION['is_admin'] == '1'){
            header("Location: Admin_Page.php");
        }

        if($_SESSION['is_admin'] == '0'){
            header("Location: user_page.php");
        }
    } else {
        header("Location: login.php");
        }
        

    ?>