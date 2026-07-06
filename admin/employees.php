<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}

// Get all employees
$sql = "SELECT * FROM employees ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการพนักงาน - DIVE</title>
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
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .btn:hover {
            background: #218838;
        }
        
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background: #f9f9f9;
        }
        
        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }
        
        .edit-btn {
            background: #007bff;
        }
        
        .delete-btn {
            background: #dc3545;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 3px;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>👥 จัดการพนักงาน</h1>
        <a href="dashboard.php" style="color: white; text-decoration: none;">← กลับ</a>
    </div>
    
    <div class="container">
        <div class="header">
            <h2>รายการพนักงาน</h2>
            <a href="#" class="btn">+ เพิ่มพนักงาน</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>แผนก</th>
                    <th>ตำแหน่ง</th>
                    <th>สถานะ</th>
                    <th>ดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['employee_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><span class="status-<?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                        <td>
                            <a href="#" class="action-btn edit-btn">แก้ไข</a>
                            <a href="#" class="action-btn delete-btn">ลบ</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
