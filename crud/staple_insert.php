<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../staple.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../staple.php');
}

$name = trim($_POST['staple_name'] ?? '');
$type = (int)($_POST['staple_type'] ?? 0);
$unit = trim($_POST['staple_unit'] ?? '');

if (empty($name) || $type <= 0) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../staple.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO staple (staple_name, staple_type_id, staple_unit) VALUES (:name, :type, :unit)");
    $stmt->execute(['name' => $name, 'type' => $type, 'unit' => $unit]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../staple.php');
} catch (PDOException $e) {
    error_log("Staple insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../staple.php');
}
?>
