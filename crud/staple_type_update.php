<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    redirect('../staple_type.php');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    alertRedirect('เกิดข้อผิดพลาดด้านความปลอดภัย', '../staple_type.php');
}

$id = (int)($_POST['staple_type_id'] ?? 0);
$name = trim($_POST['staple_type_name'] ?? '');

if ($id <= 0 || empty($name)) {
    alertRedirect('กรุณากรอกข้อมูลให้ครบถ้วน', '../staple_type.php');
}

try {
    $stmt = $pdo->prepare("UPDATE staple_type SET staple_type_name = :name WHERE staple_type_id = :id");
    $stmt->execute(['name' => $name, 'id' => $id]);
    alertRedirect('บันทึกข้อมูลสำเร็จ', '../staple_type.php');
} catch (PDOException $e) {
    error_log("Staple type update error: " . $e->getMessage());
    alertRedirect('ไม่สามารถบันทึกข้อมูลได้', '../staple_type.php');
}
?>
