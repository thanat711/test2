<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            /* พื้นหลังแบบ Gradient สีฟ้า-ม่วง ดูทันสมัย */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align_items: center;
            justify_content: center;
            font-family: 'Sarabun', sans-serif; /* แนะนำให้หา Font ไทยสวยๆ มาใส่เพิ่มได้ */
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
        }
        .form-control {
            border-radius: 20px;
            padding-left: 20px;
        }
        .btn-login {
            border-radius: 20px;
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            font-weight: bold;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }
        .input-group-text {
            background: transparent;
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
        }
        /* Custom Input Style ให้ดูคลีนๆ */
        .custom-input {
            border: none;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            padding: 10px;
        }
        .custom-input:focus {
            box-shadow: none;
            border-bottom: 2px solid #764ba2;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card card-login p-4 bg-white">
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-user-lock fa-2x"></i>
                            </div>
                            <h3 class="fw-bold text-secondary">Welcome Back</h3>
                            <p class="text-muted small">กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ</p>
                        </div>

                        <?php if(isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-check-circle me-2"></i> 
                                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

                        <?php if(isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

                        <form action="login_db.php" method="post">
                            
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user text-secondary"></i></span>
                                    <input type="text" name="username" class="form-control custom-input" placeholder="Username" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock text-secondary"></i></span>
                                    <input type="password" name="password" class="form-control custom-input" placeholder="Password" required>
                                </div>
                            </div>

                            <button type="submit" name="signin" class="btn btn-primary btn-login w-100 py-2 mb-3">
                                เข้าสู่ระบบ <i class="fas fa-sign-in-alt ms-1"></i>
                            </button>

                        </form>

                        <div class="text-center">
                            <p class="mb-1 text-muted small">ยังไม่มีบัญชีใช่ไหม?</p>
                            <a href="register.php" class="text-decoration-none fw-bold" style="color: #764ba2;">
                                สมัครสมาชิกใหม่
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