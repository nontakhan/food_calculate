<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../user.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../user.php');
}

// Only admin can add users
if (($_SESSION['level'] ?? '') !== 'admin') {
    alertRedirect('คุณไม่มีสิทธิ์ดำเนินการนี้', '../user.php');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$level = trim($_POST['level'] ?? 'user');
$status = trim($_POST['status'] ?? 'Y');

if (empty($username) || empty($password)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../user.php');
}

// Validate level
if (!in_array($level, ['admin', 'user'])) {
    $level = 'user';
}

// Validate status
if (!in_array($status, ['Y', 'N'])) {
    $status = 'Y';
}

try {
    // Check if username exists
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
    $checkStmt->execute(['username' => $username]);
    if ($checkStmt->fetchColumn() > 0) {
        alertRedirect('ชื่อผู้ใช้นี้มีอยู่แล้วในระบบ', '../user.php');
    }
    
    // Hash password
    $hashedPassword = hashPassword($password);
    
    $stmt = $pdo->prepare("INSERT INTO user (username, password, level, status) VALUES (:username, :password, :level, :status)");
    $stmt->execute([
        'username' => $username,
        'password' => $hashedPassword,
        'level' => $level,
        'status' => $status
    ]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../user.php');
} catch (PDOException $e) {
    error_log("User insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../user.php');
}
?>
