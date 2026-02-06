<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../garnish.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../garnish.php');
}

$name = trim($_POST['garnish_name'] ?? '');
$unit = trim($_POST['garnish_unit'] ?? '');

if (empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../garnish.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO garnish (garnish_name, garnish_unit) VALUES (:name, :unit)");
    $stmt->execute(['name' => $name, 'unit' => $unit]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../garnish.php');
} catch (PDOException $e) {
    error_log("Garnish insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../garnish.php');
}
?>
