<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            /* Theme เดียวกับหน้า Login */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align_items: center;
            justify_content: center;
            font-family: 'Sarabun', sans-serif;
            padding: 20px 0; /* เพิ่ม Padding กันชิดขอบบนล่างในมือถือ */
        }
        .card-register {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }
        .btn-register {
            border-radius: 20px;
            background: linear-gradient(to right, #11998e, #38ef7d); /* เปลี่ยนเป็นโทนเขียวเพื่อให้รู้ว่าเป็นปุ่มสมัคร */
            border: none;
            color: white;
            font-weight: bold;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 239, 125, 0.4);
            color: white;
        }
        .input-group-text {
            background: transparent;
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
        }
        .custom-input, .custom-select {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            padding: 10px;
        }
        .custom-input:focus, .custom-select:focus {
            box-shadow: none;
            border-bottom: 2px solid #38ef7d; /* สีโฟกัสเป็นสีเขียว */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card card-register p-4 bg-white">
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-secondary">Create Account</h3>
                            <p class="text-muted small">กรอกข้อมูลเพื่อสมัครสมาชิกใหม่</p>
                        </div>

                        <?php 
                        if(isset($_SESSION['warning'])) {
                            echo '
                            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i> '.$_SESSION['warning'].'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['warning']);
                        }
                        if(isset($_SESSION['error'])) {
                            echo '
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-times-circle me-2"></i> '.$_SESSION['error'].'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            unset($_SESSION['error']);
                        }
                        ?>

                        <form action="register_db.php" method="post">
                            
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card text-secondary"></i></span>
                                    <input type="text" name="firstname" class="form-control custom-input" placeholder="ชื่อ-นามสกุล (เช่น Somchai)" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user text-secondary"></i></span>
                                    <input type="text" name="username" class="form-control custom-input" placeholder="Username (สำหรับ Login)" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock text-secondary"></i></span>
                                    <input type="password" name="password" class="form-control custom-input" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag text-secondary"></i></span>
                                    <select name="role" class="form-select custom-select" required>
                                        <option value="" selected disabled>-- กรุณาเลือกสิทธิ์ (Role) --</option>
                                        <option value="user">User (ผู้ใช้ทั่วไป)</option>
                                        <option value="customer">Customer (ลูกค้า)</option>
                                        <option value="employee">Employee (พนักงาน)</option>
                                        <option value="admin">Admin (ผู้ดูแลระบบ)</option>
                                    </select>
                                </div>
                                <div class="form-text text-end text-muted small mt-1">* สำหรับทดสอบระบบเท่านั้น</div>
                            </div>

                            <button type="submit" name="signup" class="btn btn-register w-100 py-2 mb-3">
                                ยืนยันการสมัคร <i class="fas fa-arrow-right ms-1"></i>
                            </button>

                        </form>

                        <div class="text-center">
                            <p class="mb-1 text-muted small">เป็นสมาชิกอยู่แล้ว?</p>
                            <a href="index.php" class="text-decoration-none fw-bold" style="color: #764ba2;">
                                เข้าสู่ระบบที่นี่
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>