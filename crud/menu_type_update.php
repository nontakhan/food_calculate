<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../menu_type.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../menu_type.php');
}

$id = (int)($_POST['menu_type_id'] ?? 0);
$name = trim($_POST['menu_type_name'] ?? '');

if ($id <= 0 || empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../menu_type.php');
}

try {
    $stmt = $pdo->prepare("UPDATE menu_type SET menu_type_name = :name WHERE menu_type_id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../menu_type.php');
} catch (PDOException $e) {
    error_log("Menu type update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../menu_type.php');
}
?>
