<?php 
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $category = $_POST['category']; // <--- 1. รับค่าหมวดหมู่มา
    $price = $_POST['price'];
    $image = $_FILES['image'];

    if ($image['name'] != '') {
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($extension), $allowed)) {
            $_SESSION['status'] = "รองรับเฉพาะไฟล์ JPG, JPEG, PNG, GIF เท่านั้น";
            header("location: add_product.php");
            exit();
        }

        $new_filename = uniqid("product_", true) . "." . $extension;
        $upload_dir = 'uploads/';
        $upload_path = $upload_dir . $new_filename;

        // สร้างโฟลเดอร์ uploads อัตโนมัติถ้าไม่มี
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($image['tmp_name'], $upload_path)) {
            try {
                // 2. เพิ่ม category เข้าไปใน SQL
                $stmt = $conn->prepare("INSERT INTO products (name, category, price, image) VALUES (:name, :category, :price, :image)");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":category", $category); // <--- 3. ผูกตัวแปร category
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":image", $new_filename);
                $stmt->execute();

                $_SESSION['status'] = "เพิ่มสินค้าเรียบร้อยแล้ว!";
                header("location: add_product.php");

            } catch(PDOException $e) {
                $_SESSION['status'] = "Database Error: " . $e->getMessage();
                header("location: add_product.php");
            }
        } else {
            $_SESSION['status'] = "อัพโหลดไฟล์ไม่สำเร็จ";
            header("location: add_product.php");
        }
    } else {
        $_SESSION['status'] = "กรุณาเลือกรูปภาพ";
        header("location: add_product.php");
    }
}
?>