<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../menu.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../menu.php');
}

$menu_id = (int)($_POST['menu_id'] ?? 0);
$menu_name = trim($_POST['menu_name'] ?? '');
$menu_type = (int)($_POST['menu_type'] ?? 0);

if ($menu_id <= 0 || empty($menu_name) || $menu_type <= 0) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../menu.php');
}

try {
    $stmt = $pdo->prepare("UPDATE menu SET menu_name = :name, menu_type_id = :type WHERE menu_id = :id");
    $stmt->execute(['name' => $menu_name, 'type' => $menu_type, 'id' => $menu_id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../menu.php');
} catch (PDOException $e) {
    error_log("Menu update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../menu.php');
}
?>
