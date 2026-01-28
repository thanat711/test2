<?php 
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user') {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
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
                        <div class="mb-3 text-success">
                            <i class="fas fa-user-circle fa-4x"></i>
                        </div>
                        <h2 class="fw-bold">User Dashboard</h2>
                        <p class="text-muted">ยินดีต้อนรับสมาชิกทั่วไป</p>
                        <hr>
                        <h4 class="text-primary"><?php echo $_SESSION['username']; ?></h4>
                        <p class="badge bg-success">Role: <?php echo strtoupper($_SESSION['user_role']); ?></p>
                        
                        <div class="mt-4">
                            <a href="logout.php" class="btn btn-primary w-100">
                                <i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>