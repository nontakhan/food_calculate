<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = (int)($_GET['staple_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../staple.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM staple WHERE staple_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../staple.php');
} catch (PDOException $e) {
    error_log("Staple delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../staple.php');
}
?>
