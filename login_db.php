<?php 
session_start();
require_once 'db.php';

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $check_data = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $check_data->bindParam(":username", $username);
        $check_data->execute();
        $row = $check_data->fetch(PDO::FETCH_ASSOC);

        // ตรวจสอบว่ามี user นี้หรือไม่ และรหัสผ่านถูกต้องไหม
        if ($check_data->rowCount() > 0) {
            if (password_verify($password, $row['password'])) {
                
                // เก็บ Session สำหรับใช้งาน
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_role'] = $row['role'];
                $_SESSION['username'] = $row['firstname'];

                // แยกหน้าตาม Role
                switch($row['role']) {
                    case 'admin':
                        header("location: admin_page.php");
                        break;
                    case 'user':
                        header("location: user_page.php");
                        break;
                    case 'customer':
                        header("location: customer_page.php");
                        break;
                    case 'employee':
                        header("location: employee_page.php");
                        break;
                    default:
                        $_SESSION['error'] = "Role ของคุณไม่ถูกต้อง";
                        header("location: index.php");
                }

            } else {
                $_SESSION['error'] = "รหัสผ่านผิด";
                header("location: index.php");
            }
        } else {
            $_SESSION['error'] = "ไม่พบชื่อผู้ใช้นี้";
            header("location: index.php");
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
?>