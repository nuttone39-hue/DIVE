<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit();
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Get attendance records
$sql = "SELECT a.*, e.name, e.employee_id FROM attendance a 
        JOIN employees e ON a.employee_id = e.id 
        WHERE a.date BETWEEN ? AND ? 
        ORDER BY a.date DESC, e.name";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน - DIVE</title>
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
        
        .filter {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 10px;
            align-items: end;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .btn {
            background: #667eea;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        
        .status-present {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 3px;
        }
        
        .status-absent {
            background: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>📊 รายงาน</h1>
        <a href="dashboard.php" style="color: white; text-decoration: none;">← กลับ</a>
    </div>
    
    <div class="container">
        <div class="filter">
            <form method="GET" style="display: flex; gap: 10px; align-items: end;">
                <div class="form-group">
                    <label>วันที่เริ่มต้น:</label>
                    <input type="date" name="start_date" value="<?php echo $start_date; ?>">
                </div>
                <div class="form-group">
                    <label>วันที่สิ้นสุด:</label>
                    <input type="date" name="end_date" value="<?php echo $end_date; ?>">
                </div>
                <button type="submit" class="btn">🔍 ค้นหา</button>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>ชั่วโมงทำงาน</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
                        <td><?php echo $row['employee_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['check_in_time'] ? date('H:i', strtotime($row['check_in_time'])) : '-'; ?></td>
                        <td><?php echo $row['check_out_time'] ? date('H:i', strtotime($row['check_out_time'])) : '-'; ?></td>
                        <td><?php echo $row['work_hours'] ?? '-'; ?> ชม.</td>
                        <td><span class="status-<?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
