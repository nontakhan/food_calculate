<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../factor.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../factor.php');
}

$name = trim($_POST['factor_name'] ?? '');
$value = floatval($_POST['factor_value'] ?? 0);

if (empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../factor.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO factor (factor_name, factor_value) VALUES (:name, :value)");
    $stmt->execute(['name' => $name, 'value' => $value]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../factor.php');
} catch (PDOException $e) {
    error_log("Factor insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../factor.php');
}
?>
