<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$menu_id = (int)($_GET['menu_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($menu_id <= 0) {
    redirect('../menu.php');
}

if (!verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../menu.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM menu WHERE menu_id = :id");
    $stmt->execute(['id' => $menu_id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../menu.php');
} catch (PDOException $e) {
    error_log("Menu delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../menu.php');
}
?>
