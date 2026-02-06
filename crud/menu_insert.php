<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../menu.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../menu.php');
}

$menu_name = trim($_POST['menu_name'] ?? '');
$menu_type = (int)($_POST['menu_type'] ?? 0);

if (empty($menu_name) || $menu_type <= 0) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../menu.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO menu (menu_name, menu_type_id) VALUES (:name, :type)");
    $stmt->execute(['name' => $menu_name, 'type' => $menu_type]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../menu.php');
} catch (PDOException $e) {
    error_log("Menu insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../menu.php');
}
?>
