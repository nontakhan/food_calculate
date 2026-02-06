<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../user.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../user.php');
}

// Only admin can update users
if (($_SESSION['level'] ?? '') !== 'admin') {
    alertRedirect('คุณไม่มีสิทธิ์ดำเนินการนี้', '../user.php');
}

$id = (int)($_POST['user_id'] ?? 0);
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$level = trim($_POST['level'] ?? 'user');
$status = trim($_POST['status'] ?? 'Y');

if ($id <= 0 || empty($username)) {
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
    // If password is provided, update it too
    if (!empty($password)) {
        $hashedPassword = hashPassword($password);
        $stmt = $pdo->prepare("UPDATE user SET username = :username, password = :password, level = :level, status = :status WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword,
            'level' => $level,
            'status' => $status,
            'id' => $id
        ]);
    } else {
        $stmt = $pdo->prepare("UPDATE user SET username = :username, level = :level, status = :status WHERE id = :id");
        $stmt->execute([
            'username' => $username,
            'level' => $level,
            'status' => $status,
            'id' => $id
        ]);
    }
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../user.php');
} catch (PDOException $e) {
    error_log("User update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../user.php');
}
?>
