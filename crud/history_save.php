<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit();
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    echo json_encode(['status' => 'error', 'message' => 'CSRF token invalid']);
    exit();
}

$calc_date = $_POST['calc_date'] ?? '';
$meal_type = $_POST['meal_type'] ?? '';
$menu_ids_normal = $_POST['menu_ids_normal'] ?? '';
$menu_ids_special = $_POST['menu_ids_special'] ?? '';
$amount_normal = intval($_POST['amount_normal'] ?? 0);
$amount_special = intval($_POST['amount_special'] ?? 0);
$edit_id = intval($_POST['edit_id'] ?? 0);
$force_update = intval($_POST['force_update'] ?? 0);

// Validate
if (empty($calc_date) || empty($meal_type) || empty($menu_ids_normal) || $amount_normal <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน']);
    exit();
}

if (!in_array($meal_type, ['breakfast', 'lunch', 'dinner'])) {
    echo json_encode(['status' => 'error', 'message' => 'ประเภทมื้ออาหารไม่ถูกต้อง']);
    exit();
}

// Sanitize menu IDs
$menu_ids_normal = implode(',', array_map('intval', array_filter(explode(',', $menu_ids_normal), 'strlen')));
$menu_ids_special = implode(',', array_map('intval', array_filter(explode(',', $menu_ids_special), 'strlen')));

$meal_labels = ['breakfast' => 'เช้า', 'lunch' => 'เที่ยง', 'dinner' => 'เย็น'];

try {
    if ($edit_id > 0 || $force_update) {
        // Update existing record
        $update_id = $edit_id;
        $stmt = $pdo->prepare("UPDATE calculate_history SET calc_date = :calc_date, meal_type = :meal_type, menu_ids_normal = :normal, menu_ids_special = :special, amount_normal = :amt_normal, amount_special = :amt_special, created_by = :user WHERE history_id = :id");
        $stmt->execute([
            'calc_date' => $calc_date,
            'meal_type' => $meal_type,
            'normal' => $menu_ids_normal,
            'special' => $menu_ids_special,
            'amt_normal' => $amount_normal,
            'amt_special' => $amount_special,
            'user' => $_SESSION['ses_username'] ?? '',
            'id' => $update_id
        ]);
        echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลวันที่ ' . $calc_date . ' มื้อ' . $meal_labels[$meal_type] . ' สำเร็จ']);
    } else {
        // Check for duplicate (same date + meal_type)
        $stmt = $pdo->prepare("SELECT history_id FROM calculate_history WHERE calc_date = :calc_date AND meal_type = :meal_type");
        $stmt->execute(['calc_date' => $calc_date, 'meal_type' => $meal_type]);
        $existing = $stmt->fetch();

        if ($existing) {
            echo json_encode([
                'status' => 'duplicate',
                'message' => 'มีข้อมูลวันที่ ' . $calc_date . ' มื้อ' . $meal_labels[$meal_type] . ' อยู่แล้ว ต้องการบันทึกทับหรือไม่?',
                'existing_id' => $existing['history_id']
            ]);
        } else {
            // Insert new record
            $stmt = $pdo->prepare("INSERT INTO calculate_history (calc_date, meal_type, menu_ids_normal, menu_ids_special, amount_normal, amount_special, created_by) VALUES (:calc_date, :meal_type, :normal, :special, :amt_normal, :amt_special, :user)");
            $stmt->execute([
                'calc_date' => $calc_date,
                'meal_type' => $meal_type,
                'normal' => $menu_ids_normal,
                'special' => $menu_ids_special,
                'amt_normal' => $amount_normal,
                'amt_special' => $amount_special,
                'user' => $_SESSION['ses_username'] ?? ''
            ]);
            echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลวันที่ ' . $calc_date . ' มื้อ' . $meal_labels[$meal_type] . ' สำเร็จ']);
        }
    }
} catch (PDOException $e) {
    error_log("History save error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถบันทึกข้อมูลได้: ' . $e->getMessage()]);
}
?>
