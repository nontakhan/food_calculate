<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../garnish.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../garnish.php');
}

$id = (int)($_POST['garnish_id'] ?? 0);
$name = trim($_POST['garnish_name'] ?? '');
$unit = trim($_POST['garnish_unit'] ?? '');

if ($id <= 0 || empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../garnish.php');
}

try {
    $stmt = $pdo->prepare("UPDATE garnish SET garnish_name = :name, garnish_unit = :unit WHERE garnish_id = :id");
    $stmt->execute(['name' => $name, 'unit' => $unit, 'id' => $id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../garnish.php');
} catch (PDOException $e) {
    error_log("Garnish update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../garnish.php');
}
?>
