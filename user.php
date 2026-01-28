<?php
include "db.php";
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}
echo "ยินดีต้อนรับ USER";
