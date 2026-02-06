<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

// Only admin can delete users
if (($_SESSION['level'] ?? '') !== 'admin') {
    alertRedirect('คุณไม่มีสิทธิ์ดำเนินการนี้', '../user.php');
}

$id = (int)($_GET['user_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../user.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../user.php');
} catch (PDOException $e) {
    error_log("User delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../user.php');
}
?>
