<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}

// Get statistics
$total_employees = $conn->query("SELECT COUNT(*) as count FROM employees WHERE status = 'active'")->fetch_assoc()['count'];
$today = date('Y-m-d');
$present_today = $conn->query("SELECT COUNT(*) as count FROM attendance WHERE date = '$today' AND status = 'present'")->fetch_assoc()['count'];
$absent_today = $conn->query("SELECT COUNT(*) as count FROM attendance WHERE date = '$today' AND status = 'absent'")->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แอดมิน - DIVE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stat-card h3 {
            color: #667eea;
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            color: #666;
        }
        
        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .menu-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .menu-item:hover {
            transform: translateY(-5px);
        }
        
        .menu-item a {
            text-decoration: none;
            color: #333;
        }
        
        .menu-item h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🔐 Admin - DIVE</h1>
        <a href="../logout.php" style="color: white; text-decoration: none;">ออกจากระบบ</a>
    </div>
    
    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $total_employees; ?></h3>
                <p>พนักงานทั้งหมด</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $present_today; ?></h3>
                <p>เข้างานวันนี้</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $absent_today; ?></h3>
                <p>ขาดงานวันนี้</p>
            </div>
        </div>
        
        <h2 style="margin-bottom: 20px;">จัดการระบบ</h2>
        <div class="menu">
            <div class="menu-item">
                <a href="employees.php">
                    <h4>👥 พนักงาน</h4>
                    <p>จัดการข้อมูลพนักงาน</p>
                </a>
            </div>
            <div class="menu-item">
                <a href="reports.php">
                    <h4>📊 รายงาน</h4>
                    <p>ดูรายงานการเข้า-ออก</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
