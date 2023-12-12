<?php
session_start(); // Make sure to start the session at the beginning of your script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check password regardless of the user's role
        if (password_verify($password, $row["password"])) {
            // Set session variable
            $_SESSION["user_id"] = $row["user_id"];

            // Redirect based on user role
            if ($row['is_admin'] == 'admin') {
                header("Location: admin_page.php");
                exit();
            } else {
                header("Location: user_page.php");
                exit();
            }
        } else {
            // Incorrect password
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!'
                });
            </script>";
        }
    } else {
        // Username not found
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!'
            });
        </script>";
    }
}
?>