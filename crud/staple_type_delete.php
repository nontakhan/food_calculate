<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = (int)($_GET['staple_type_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../staple_type.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM staple_type WHERE staple_type_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../staple_type.php');
} catch (PDOException $e) {
    error_log("Staple type delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../staple_type.php');
}
?>
