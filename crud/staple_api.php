<?php
/**
 * Server-side DataTables API for Staple (วัตถุดิบ)
 * Supports search, pagination, sorting via AJAX
 */
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

header('Content-Type: application/json; charset=utf-8');

// DataTables parameters
$draw = intval($_GET['draw'] ?? 1);
$start = intval($_GET['start'] ?? 0);
$length = intval($_GET['length'] ?? 25);
$searchValue = trim($_GET['search']['value'] ?? '');
$orderCol = intval($_GET['order'][0]['column'] ?? 0);
$orderDir = ($_GET['order'][0]['dir'] ?? 'asc') === 'desc' ? 'DESC' : 'ASC';

// Column mapping for ORDER BY
$columns = ['s.staple_id', 's.staple_name', 's.staple_serve', 'm.menu_name', 's.staple_yield', 't.staple_type_name', 's.is_fish'];
$orderColumn = $columns[$orderCol] ?? 's.staple_id';

try {
    // Total records (no filter)
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM staple");
    $totalRecords = $totalStmt->fetchColumn();

    // Base query
    $baseQuery = "FROM staple s 
                  LEFT JOIN menu m ON m.menu_id = s.menu_id
                  LEFT JOIN staple_type t ON t.id = s.staple_type_id";

    // Search filter
    $searchWhere = '';
    $params = [];
    if ($searchValue !== '') {
        $searchWhere = " WHERE (s.staple_name LIKE :search 
                         OR m.menu_name LIKE :search2 
                         OR t.staple_type_name LIKE :search3)";
        $params['search'] = "%{$searchValue}%";
        $params['search2'] = "%{$searchValue}%";
        $params['search3'] = "%{$searchValue}%";
    }

    // Filtered count
    $filteredStmt = $pdo->prepare("SELECT COUNT(*) {$baseQuery}{$searchWhere}");
    $filteredStmt->execute($params);
    $filteredRecords = $filteredStmt->fetchColumn();

    // Data query with pagination
    $dataQuery = "SELECT s.staple_id, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, 
                         s.menu_id, s.staple_type_id,
                         m.menu_name, t.staple_type_name
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
    $rowNum = $start + 1;
    while ($row = $dataStmt->fetch()) {
        $isFishBadge = $row['is_fish'] == 1 
            ? '<span class="badge bg-primary">ใช่</span>' 
            : '<span class="badge bg-secondary">ไม่ใช่</span>';

        $data[] = [
            'DT_RowId' => 'row_' . $row['staple_id'],
            'num' => $rowNum,
            'staple_name' => htmlspecialchars($row['staple_name'] ?? '', ENT_QUOTES, 'UTF-8'),
            'staple_serve' => htmlspecialchars($row['staple_serve'] ?? '', ENT_QUOTES, 'UTF-8'),
            'menu_name' => '<span class="badge bg-info">' . htmlspecialchars($row['menu_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</span>',
            'staple_yield' => htmlspecialchars($row['staple_yield'] ?? '', ENT_QUOTES, 'UTF-8'),
            'staple_type_name' => htmlspecialchars($row['staple_type_name'] ?? '', ENT_QUOTES, 'UTF-8'),
            'is_fish' => $isFishBadge,
            'actions' => '', // Will be built client-side
            // Raw data for edit modal
            'raw' => [
                'staple_id' => (int)$row['staple_id'],
                'staple_name' => $row['staple_name'],
                'staple_serve' => $row['staple_serve'],
                'menu_id' => (int)$row['menu_id'],
                'staple_type_id' => (int)$row['staple_type_id'],
                'staple_yield' => $row['staple_yield'],
                'is_fish' => (int)$row['is_fish'],
            ]
        ];
        $rowNum++;
    }

    echo json_encode([
        'draw' => $draw,
        'recordsTotal' => (int)$totalRecords,
        'recordsFiltered' => (int)$filteredRecords,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    error_log("Staple API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'draw' => $draw,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => [],
        'error' => 'เกิดข้อผิดพลาดในการโหลดข้อมูล'
    ], JSON_UNESCAPED_UNICODE);
}
?>
