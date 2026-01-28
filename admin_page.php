<?php 
session_start();
// Security Check: ต้องเป็น admin เท่านั้น
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align_items: center;
            justify_content: center;
            font-family: 'Sarabun', sans-serif;
        }
        .card-dashboard {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-dashboard p-4 text-center">
                    <div class="card-body">
                        <div class="mb-3 text-danger">
                            <i class="fas fa-user-shield fa-4x"></i>
                        </div>
                        <h2 class="fw-bold">Admin Dashboard</h2>
                        <p class="text-muted">ยินดีต้อนรับผู้ดูแลระบบ</p>
                        <hr>
                        <h4 class="text-primary"><?php echo $_SESSION['username']; ?></h4>
                        <p class="badge bg-danger">Role: <?php echo strtoupper($_SESSION['user_role']); ?></p>
                        
                        <div class="mt-4">
    <div class="d-grid gap-2">
        <a href="add_user.php" class="btn btn-success text-start">
            <i class="fas fa-user-plus me-2"></i> เพิ่มผู้ใช้งานใหม่
        </a>
        <a href="add_product.php" class="btn btn-warning text-start text-dark">
            <i class="fas fa-box-open me-2"></i> เพิ่มสินค้าใหม่
        </a>
        <button class="btn btn-outline-secondary text-start" disabled>
            <i class="fas fa-list me-2"></i> จัดการรายการ (Coming Soon)
        </button>
    </div>
    
    <hr>
    <a href="show_products.php" class="btn btn-primary text-start">
    <i class="fas fa-eye me-2"></i> ดูรายการสินค้า (หน้าบ้าน)
</a>
    <hr>
    <a href="logout.php" class="btn btn-danger w-100">
        <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
    </a>
</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>