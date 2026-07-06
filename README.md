# 🏢 DIVE - Employee Check-in System

ระบบจัดการเข้า-ออกพนักงาน

## 🎯 ฟีเจอร์

- ✅ ระบบล็อกอิน สำหรับพนักงาน
- ✅ Check-in / Check-out ง่ายๆ
- ✅ ดูประวัติการเข้า-ออก
- ✅ Admin Dashboard สำหรับจัดการข้อมูล
- ✅ รายงานการเข้า-ออก
- ✅ จัดการข้อมูลพนักงาน

## 📁 โครงสร้างไฟล์

```
DIVE/
├── index.php                 # หน้าหลัก
├── login.php                 # หน้า login
├── dashboard.php             # dashboard พนักงาน
├── checkin.php               # ฟังก์ชัน check-in
├── checkout.php              # ฟังก์ชัน check-out
├── logout.php                # ออกจากระบบ
├── config/
│   └── database.php          # เชื่อมต่อฐานข้อมูล
├── database/
│   └── checkin.sql           # SQL schema
├── admin/
│   ├── dashboard.php         # dashboard admin
│   ├── employees.php         # จัดการพนักงาน
│   └── reports.php           # รายงาน
└── assets/                   # CSS, JS, images
```

## 🚀 การติดตั้ง

### 1. Clone Repository
```bash
git clone https://github.com/nuttone39-hue/DIVE.git
cd DIVE
```

### 2. ตั้งค่าฐานข้อมูล
- เปิด XAMPP/WAMP
- สร้าง database ใหม่ หรือนำเข้า `database/checkin.sql`

### 3. ตั้งค่าการเชื่อมต่อฐานข้อมูล
แก้ไขไฟล์ `config/database.php`:
```php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dive_employee";
```

### 4. รันระบบ
- ไปที่ `http://localhost/DIVE/`

## 👤 บัญชี Demo

### พนักงาน
- อีเมล: `employee@example.com`
- รหัสผ่าน: `password123`

### Admin
- ชื่อผู้ใช้: `admin`
- รหัสผ่าน: `admin123`

## 📊 ฐานข้อมูล

### ตาราง Employees
- ID
- Employee ID
- Name
- Email
- Password (Hash)
- Phone
- Department
- Position
- Hire Date
- Salary
- Status

### ตาราง Attendance
- ID
- Employee ID
- Check-in Time
- Check-out Time
- Work Hours
- Date
- Status
- Notes

## 🔒 ความปลอดภัย

- ✅ Password Hashing (bcrypt)
- ✅ Session Management
- ✅ SQL Injection Prevention (Prepared Statements)
- ✅ CSRF Protection

## 📝 License

MIT License

## 👨‍💻 Developer

nuttone39-hue

---

**หมายเหตุ:** นี่คือระบบพื้นฐาน สามารถพัฒนาต่อเพิ่มเติมได้ตามความต้องการ
