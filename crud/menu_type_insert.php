<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../menu_type.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../menu_type.php');
}

$name = trim($_POST['menu_type_name'] ?? '');

if (empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../menu_type.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO menu_type (menu_type_name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../menu_type.php');
} catch (PDOException $e) {
    error_log("Menu type insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../menu_type.php');
}
?>
