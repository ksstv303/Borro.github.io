<?php
// เริ่ม session
session_start();

 if (session_destroy()){
     header("Location: login.php");
 }
 exit();
?>