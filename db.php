<?php
$servername = "localhost";
$username = "root";
$password = ""; // ถ้ามีรหัสผ่าน XAMPP/MAMP ให้ใส่ตรงนี้
$dbname = "login_system";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // ตั้งค่า error mode เป็น exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>