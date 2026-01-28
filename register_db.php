<?php 
session_start();
require_once 'db.php';

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // 1. ตรวจสอบว่า Username ซ้ำหรือไม่
    try {
        $check_user = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $check_user->bindParam(":username", $username);
        $check_user->execute();
        
        if ($check_user->rowCount() > 0) {
            // ถ้ามี Username นี้ในระบบแล้ว
            $_SESSION['warning'] = "Username นี้มีผู้ใช้งานแล้ว กรุณาเปลี่ยนใหม่";
            header("location: register.php");
        } else {
            // 2. ถ้าไม่ซ้ำ ให้เข้ารหัส Password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // 3. บันทึกข้อมูลลงฐานข้อมูล
            $stmt = $conn->prepare("INSERT INTO users (firstname, username, password, role) 
                                    VALUES (:firstname, :username, :password, :role)");
            $stmt->bindParam(":firstname", $firstname);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password_hash);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            // สมัครเสร็จ ส่งกลับไปหน้า Login
            $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว! กรุณาเข้าสู่ระบบ";
            header("location: index.php");
        }

    } catch(PDOException $e) {
        $_SESSION['error'] = "มีบางอย่างผิดพลาด: " . $e->getMessage();
        header("location: register.php");
    }
}
?>