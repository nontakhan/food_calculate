<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = (int)($_GET['factor_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../factor.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM factor WHERE factor_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../factor.php');
} catch (PDOException $e) {
    error_log("Factor delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../factor.php');
}
?>
