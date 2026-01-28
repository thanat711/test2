<?php 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
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
            padding: 20px 0;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19);
        }
        .custom-input, .custom-select { border: none; border-bottom: 1px solid #ced4da; border-radius: 0; padding: 10px; }
        .custom-input:focus, .custom-select:focus { box-shadow: none; border-bottom: 2px solid #ffc107; }
        .input-group-text { background: transparent; border: none; border-bottom: 1px solid #ced4da; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card card-custom p-4 bg-white">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-box-open fa-lg"></i>
                            </div>
                            <h4 class="fw-bold text-secondary">เพิ่มสินค้าใหม่</h4>
                        </div>

                        <?php if(isset($_SESSION['status'])) { ?>
                            <div class="alert alert-info alert-dismissible fade show">
                                <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php } ?>

                        <form action="add_product_db.php" method="post" enctype="multipart/form-data">
                            
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-tag text-secondary"></i></span>
                                <input type="text" name="name" class="form-control custom-input" placeholder="ชื่อสินค้า" required>
                            </div>

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-layer-group text-secondary"></i></span>
                                <select name="category" class="form-select custom-select" required>
                                    <option value="" selected disabled>-- เลือกหมวดหมู่ --</option>
                                    <option value="electronics">อุปกรณ์อิเล็กทรอนิกส์</option>
                                    <option value="clothing">เสื้อผ้าและแฟชั่น</option>
                                    <option value="home">ของใช้ในบ้าน</option>
                                    <option value="toys">ของเล่น</option>
                                    <option value="general">สินค้าทั่วไป</option>
                                    <option value="Food and Beverage">อาหารและเครื่องดื่ม</option>
                                </select>
                            </div>

                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-baht-sign text-secondary"></i></span>
                                <input type="number" step="0.01" name="price" class="form-control custom-input" placeholder="ราคา (บาท)" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-muted small">รูปภาพสินค้า</label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="add_product" class="btn btn-warning text-dark rounded-pill">บันทึกสินค้า</button>
                                <a href="admin_page.php" class="btn btn-secondary rounded-pill">กลับหน้า Admin</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>