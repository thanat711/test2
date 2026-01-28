<?php 
session_start();
require_once 'db.php';

// 1. เช็คสิทธิ์ Admin (สำคัญมาก ห้ามให้คนอื่นลบเล่น)
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // 2. ดึงข้อมูลสินค้าก่อน เพื่อจะเอาชื่อรูปภาพไปลบ
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // ถ้าเจอสินค้านั้น
        if ($product) {
            
            // 3. ลบไฟล์รูปภาพออกจากโฟลเดอร์ uploads/
            $file_path = "uploads/" . $product['image'];
            
            if (file_exists($file_path)) {
                unlink($file_path); // คำสั่งลบไฟล์
            }

            // 4. ลบข้อมูลออกจากฐานข้อมูล
            $del_stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
            $del_stmt->bindParam(":id", $id);
            $del_stmt->execute();

            $_SESSION['status'] = "ลบสินค้าเรียบร้อยแล้ว!"; // ส่งข้อความแจ้งเตือน (ถ้าหน้า show_products รองรับ)
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// ลบเสร็จ ดีดกลับไปหน้าแสดงสินค้า
header("location: show_products.php");
?>