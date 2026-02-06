<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../factor.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../factor.php');
}

$id = (int)($_POST['factor_id'] ?? 0);
$name = trim($_POST['factor_name'] ?? '');
$value = floatval($_POST['factor_value'] ?? 0);

if ($id <= 0 || empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../factor.php');
}

try {
    $stmt = $pdo->prepare("UPDATE factor SET factor_name = :name, factor_value = :value WHERE factor_id = :id");
    $stmt->execute(['name' => $name, 'value' => $value, 'id' => $id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../factor.php');
} catch (PDOException $e) {
    error_log("Factor update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../factor.php');
}
?>
