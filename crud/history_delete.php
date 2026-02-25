<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = intval($_GET['history_id'] ?? 0);
$token = $_GET['token'] ?? '';

if ($id <= 0 || !verifyCsrfToken($token)) {
    alertRedirect('เกิดข้อผิดพลาด', '../history.php');
}

try {
    $stmt = $pdo->prepare("DELETE FROM calculate_history WHERE history_id = :id");
    $stmt->execute(['id' => $id]);
    alertRedirect('ลบข้อมูลสำเร็จ', '../history.php');
} catch (PDOException $e) {
    error_log("History delete error: " . $e->getMessage());
    alertRedirect('ไม่สามารถลบข้อมูลได้', '../history.php');
}
?>
