<?php 
session_start();
require_once 'db.php';

// ดึงข้อมูลสินค้าทั้งหมดจากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa; /* สีพื้นหลังสว่างๆ สบายตา */
            font-family: 'Sarabun', sans-serif;
        }
        .product-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .product-img-box {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e9ecef;
        }
        .product-img-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover; /* ทำให้รูปเต็มกรอบสวยงาม */
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-store me-2"></i>My Shop</a>
            <div class="ms-auto">
                <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
                    <a href="admin_page.php" class="btn btn-outline-light btn-sm">กลับหน้า Admin</a>
                <?php } else { ?>
                    <a href="index.php" class="btn btn-outline-light btn-sm">กลับหน้าหลัก</a>
                <?php } ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">สินค้าทั้งหมด</h2>
            <p class="text-muted"></p>
        </div>

        <div class="row">
            <?php if(count($products) > 0) { ?>
                
                <?php foreach($products as $product) { ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="product-img-box">
                            <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </div>
                        
                        <div class="card-body text-center">
    <h5 class="card-title fw-bold"><?php echo $product['name']; ?></h5>
    <p class="card-text text-success fs-5">
        <?php echo number_format($product['price'], 2); ?> ฿
    </p>
    
    <button class="btn btn-primary w-100 rounded-pill mb-2">
        <i class="fas fa-cart-plus me-1"></i> สั่งซื้อ
    </button>

    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { ?>
        <a href="delete_product.php?id=<?php echo $product['id']; ?>" 
           class="btn btn-danger w-100 rounded-pill"
           onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบสินค้านี้? การกระทำนี้ไม่สามารถย้อนกลับได้');">
           <i class="fas fa-trash-alt me-1"></i> ลบสินค้า
        </a>
    <?php } ?>

</div>
                    </div>
                </div>
                <?php } ?>

            <?php } else { ?>
                <div class="col-12 text-center p-5">
                    <h4 class="text-muted">ยังไม่มีสินค้าในระบบ</h4>
                    <p>กรุณาให้ Admin เพิ่มสินค้าก่อน</p>
                </div>
            <?php } ?>
        </div>
    </div>

</body>
</html>