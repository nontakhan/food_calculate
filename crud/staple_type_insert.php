<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['save'])) {
    redirect('../staple_type.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../staple_type.php');
}

$name = trim($_POST['staple_type_name'] ?? '');

if (empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../staple_type.php');
}

try {
    $stmt = $pdo->prepare("INSERT INTO staple_type (staple_type_name) VALUES (:name)");
    $stmt->execute(['name' => $name]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../staple_type.php');
} catch (PDOException $e) {
    error_log("Staple type insert error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../staple_type.php');
}
?>
