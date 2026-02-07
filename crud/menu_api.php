<?php
/**
 * Server-side DataTables API for Menu (รายการอาหาร)
 * Supports search, pagination, sorting via AJAX
 */
ob_start();

// Start session and load DB without the default session.php redirect behavior
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . '/_db/connect.php';

// Clear any stray output from includes (BOM, whitespace, PHP warnings)
ob_end_clean();

header('Content-Type: application/json; charset=utf-8');

// Check session - return JSON error instead of HTML redirect
if (empty($_SESSION['ses_username'])) {
    http_response_code(401);
    echo json_encode(['draw' => 1, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => [], 'error' => 'Session expired'], JSON_UNESCAPED_UNICODE);
    exit();
}

// DataTables parameters
$draw = intval($_GET['draw'] ?? 1);
$start = intval($_GET['start'] ?? 0);
$length = intval($_GET['length'] ?? 25);
$searchValue = trim($_GET['search']['value'] ?? '');
$orderCol = intval($_GET['order'][0]['column'] ?? 0);
$orderDir = ($_GET['order'][0]['dir'] ?? 'asc') === 'desc' ? 'DESC' : 'ASC';

// Column mapping for ORDER BY
$columns = ['m.menu_id', 'm.menu_name', 't.menu_type_name'];
$orderColumn = $columns[$orderCol] ?? 'm.menu_id';

try {
    // Total records
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM menu");
    $totalRecords = $totalStmt->fetchColumn();

    // Base query
    $baseQuery = "FROM menu m LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id";

    // Search filter
    $searchWhere = '';
    $params = [];
    if ($searchValue !== '') {
        $searchWhere = " WHERE (m.menu_name LIKE :search OR t.menu_type_name LIKE :search2)";
        $params['search'] = "%{$searchValue}%";
        $params['search2'] = "%{$searchValue}%";
    }

    // Filtered count
    $filteredStmt = $pdo->prepare("SELECT COUNT(*) {$baseQuery}{$searchWhere}");
    $filteredStmt->execute($params);
    $filteredRecords = $filteredStmt->fetchColumn();

    // Data query with pagination
    $dataQuery = "SELECT m.menu_id, m.menu_name, m.menu_type_id, t.menu_type_name
                  {$baseQuery}{$searchWhere}
                  ORDER BY {$orderColumn} {$orderDir}
                  LIMIT :start, :length";

    $dataStmt = $pdo->prepare($dataQuery);
    foreach ($params as $key => $val) {
        $dataStmt->bindValue(":{$key}", $val, PDO::PARAM_STR);
    }
    $dataStmt->bindValue(':start', $start, PDO::PARAM_INT);
    $dataStmt->bindValue(':length', $length, PDO::PARAM_INT);
    $dataStmt->execute();

    $data = [];
    while ($row = $dataStmt->fetch()) {
        $data[] = [
            'DT_RowId' => 'row_' . $row['menu_id'],
            'menu_id' => htmlspecialchars($row['menu_id'] ?? '', ENT_QUOTES, 'UTF-8'),
            'menu_name' => htmlspecialchars($row['menu_name'] ?? '', ENT_QUOTES, 'UTF-8'),
            'menu_type_name' => '<span class="badge bg-info">' . htmlspecialchars($row['menu_type_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>',
            'actions' => '',
            'raw' => [
                'menu_id' => (int)$row['menu_id'],
                'menu_name' => $row['menu_name'],
                'menu_type_id' => (int)$row['menu_type_id'],
            ]
        ];
    }

    echo json_encode([
        'draw' => $draw,
        'recordsTotal' => (int)$totalRecords,
        'recordsFiltered' => (int)$filteredRecords,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    error_log("Menu API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'draw' => $draw,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'เกิดข้อผิดพลาดในการโหลดข้อมูล: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    error_log("Menu API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'draw' => $draw ?? 1,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
?>
