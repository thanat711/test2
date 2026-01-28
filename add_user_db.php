<?php 
session_start();
require_once 'db.php';

// Security Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}

if (isset($_POST['add_user'])) {
    $firstname = $_POST['firstname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    try {
        // เช็ค username ซ้ำ
        $check = $conn->prepare("SELECT username FROM users WHERE username = :username");
        $check->bindParam(":username", $username);
        $check->execute();

        if ($check->rowCount() > 0) {
            $_SESSION['status'] = "Username นี้มีอยู่แล้ว!";
            header("location: add_user.php");
        } else {
            $stmt = $conn->prepare("INSERT INTO users (firstname, username, password, role) VALUES (:f, :u, :p, :r)");
            $stmt->execute(['f'=>$firstname, 'u'=>$username, 'p'=>$password, 'r'=>$role]);
            
            $_SESSION['status'] = "เพิ่มผู้ใช้สำเร็จ!";
            header("location: add_user.php");
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>