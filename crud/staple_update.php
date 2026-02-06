<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../staple.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../staple.php');
}

$id = (int)($_POST['staple_id'] ?? 0);
$name = trim($_POST['staple_name'] ?? '');
$type = (int)($_POST['staple_type'] ?? 0);
$unit = trim($_POST['staple_unit'] ?? '');

if ($id <= 0 || empty($name) || $type <= 0) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../staple.php');
}

try {
    $stmt = $pdo->prepare("UPDATE staple SET staple_name = :name, staple_type_id = :type, staple_unit = :unit WHERE staple_id = :id");
    $stmt->execute(['name' => $name, 'type' => $type, 'unit' => $unit, 'id' => $id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../staple.php');
} catch (PDOException $e) {
    error_log("Staple update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../staple.php');
}
?>
