<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = (int)($_GET['menu_type_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../menu_type.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM menu_type WHERE menu_type_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../menu_type.php');
} catch (PDOException $e) {
    error_log("Menu type delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../menu_type.php');
}
?>
