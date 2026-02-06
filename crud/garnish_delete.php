<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = (int)($_GET['garnish_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../garnish.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM garnish WHERE garnish_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../garnish.php');
} catch (PDOException $e) {
    error_log("Garnish delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../garnish.php');
}
?>
