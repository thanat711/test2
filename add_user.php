<?php 
session_start();
// Security Check: ต้องเป็น Admin เท่านั้น
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
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
        .input-group-text { background: transparent; border: none; border-bottom: 1px solid #ced4da; }
        .custom-input, .custom-select { border: none; border-bottom: 1px solid #ced4da; border-radius: 0; padding: 10px; }
        .custom-input:focus, .custom-select:focus { box-shadow: none; border-bottom: 2px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card card-custom p-4 bg-white">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user-plus fa-lg"></i>
                            </div>
                            <h4 class="fw-bold text-secondary">เพิ่มผู้ใช้งานใหม่</h4>
                        </div>

                        <?php if(isset($_SESSION['status'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php } ?>

                        <form action="add_user_db.php" method="post">
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-id-card text-secondary"></i></span>
                                <input type="text" name="firstname" class="form-control custom-input" placeholder="ชื่อ-นามสกุล" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-user text-secondary"></i></span>
                                <input type="text" name="username" class="form-control custom-input" placeholder="Username" required>
                            </div>
                            <div class="mb-3 input-group">
                                <span class="input-group-text"><i class="fas fa-lock text-secondary"></i></span>
                                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required>
                            </div>
                            <div class="mb-4 input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag text-secondary"></i></span>
                                <select name="role" class="form-select custom-select" required>
                                    <option value="" selected disabled>-- เลือกสิทธิ์ (Role) --</option>
                                    <option value="user">User</option>
                                    <option value="customer">Customer</option>
                                    <option value="employee">Employee</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="add_user" class="btn btn-success rounded-pill">บันทึกข้อมูล</button>
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