<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '_db/connect.php';

$meal_labels = ['breakfast' => 'เช้า', 'lunch' => 'เที่ยง', 'dinner' => 'เย็น'];

// Get parameters
$date_from = $_GET['date_from'] ?? date('Y-m-d');
$date_to = $_GET['date_to'] ?? date('Y-m-d');
$meal_filter = $_GET['meal_type'] ?? 'all';

// Build query
$params = ['date_from' => $date_from, 'date_to' => $date_to];
$where = "calc_date BETWEEN :date_from AND :date_to";
if ($meal_filter !== 'all' && in_array($meal_filter, ['breakfast', 'lunch', 'dinner'])) {
    $where .= " AND meal_type = :meal_type";
    $params['meal_type'] = $meal_filter;
}

$stmt = $pdo->prepare("SELECT * FROM calculate_history WHERE $where ORDER BY calc_date, FIELD(meal_type, 'breakfast', 'lunch', 'dinner')");
$stmt->execute($params);
$histories = $stmt->fetchAll();

// Collect all ingredients grouped by staple_type
$all_ingredients = [];
$all_garnishes = [];

foreach ($histories as $hist) {
    $menu_final = implode(',', array_map('intval', explode(',', $hist['menu_ids_normal'])));
    $menu_final2 = !empty($hist['menu_ids_special']) ? implode(',', array_map('intval', explode(',', $hist['menu_ids_special']))) : '';
    $total_menu = $menu_final2 ? $menu_final . ',' . $menu_final2 : $menu_final;
    $total = intval($hist['amount_normal']);
    $total2 = intval($hist['amount_special']);

    // Normal room ingredients
    $sql = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, f.factor_value, 
            COALESCE(st.staple_type_name, 'อื่นๆ') as staple_type_name
            FROM staple s 
            LEFT JOIN menu m ON m.menu_id = s.menu_id 
            LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id 
            LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id 
            LEFT JOIN staple_type st ON st.id = s.staple_type_id
            WHERE m.menu_id IN ($menu_final) ORDER BY m.menu_id";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        $yield = ($row['staple_serve'] * $row['factor_value'] * 100) / $row['staple_yield'];
        $grams = $yield * $total;
        $type_name = $row['staple_type_name'];
        $staple_name = $row['staple_name'];

        if (!isset($all_ingredients[$type_name][$staple_name])) {
            $all_ingredients[$type_name][$staple_name] = ['grams' => 0, 'egg' => 0, 'fish' => 0, 'is_egg' => false, 'is_fish' => false];
        }
        $all_ingredients[$type_name][$staple_name]['grams'] += $grams;
        if (strpos($staple_name, 'ไข่') !== false) {
            $all_ingredients[$type_name][$staple_name]['egg'] += $grams / 31.9;
            $all_ingredients[$type_name][$staple_name]['is_egg'] = true;
        }
        if ($row['is_fish'] == 1) {
            $all_ingredients[$type_name][$staple_name]['fish'] += $total;
            $all_ingredients[$type_name][$staple_name]['is_fish'] = true;
        }
    }

    // Special room ingredients
    if (!empty($menu_final2)) {
        $sql2 = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, f.factor_value, 
                COALESCE(st.staple_type_name, 'อื่นๆ') as staple_type_name
                FROM staple s 
                LEFT JOIN menu m ON m.menu_id = s.menu_id 
                LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id 
                LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id 
                LEFT JOIN staple_type st ON st.id = s.staple_type_id
                WHERE m.menu_id IN ($menu_final2) ORDER BY m.menu_id";
        $res2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_array($res2)) {
            $yield2 = ($row2['staple_serve'] * $row2['factor_value'] * 100) / $row2['staple_yield'];
            $grams2 = $yield2 * $total2;
            $type_name = $row2['staple_type_name'];
            $staple_name = $row2['staple_name'];

            if (!isset($all_ingredients[$type_name][$staple_name])) {
                $all_ingredients[$type_name][$staple_name] = ['grams' => 0, 'egg' => 0, 'fish' => 0, 'is_egg' => false, 'is_fish' => false];
            }
            $all_ingredients[$type_name][$staple_name]['grams'] += $grams2;
            if (strpos($staple_name, 'ไข่') !== false) {
                $all_ingredients[$type_name][$staple_name]['egg'] += $grams2 / 31.9;
                $all_ingredients[$type_name][$staple_name]['is_egg'] = true;
            }
            if ($row2['is_fish'] == 1) {
                $all_ingredients[$type_name][$staple_name]['fish'] += $total2;
                $all_ingredients[$type_name][$staple_name]['is_fish'] = true;
            }
        }
    }

    // Garnishes
    $sql_g = "SELECT GROUP_CONCAT(menu_name) menu_name, garnish_name, garnish_value 
              FROM (SELECT g.garnish_name, g.garnish_value, m.menu_name FROM garnish g LEFT JOIN menu m ON m.menu_id = g.menu_id WHERE m.menu_id IN ($total_menu)) a 
              GROUP BY garnish_name ORDER BY menu_name";
    $res_g = mysqli_query($conn, $sql_g);
    while ($row_g = mysqli_fetch_array($res_g)) {
        $g_name = $row_g['garnish_name'];
        if (!isset($all_garnishes[$g_name])) {
            $all_garnishes[$g_name] = 0;
        }
        $all_garnishes[$g_name] += $row_g['garnish_value'];
    }
}

// Format dates for display
$thai_date_from = date('d/m/', strtotime($date_from)) . (date('Y', strtotime($date_from)) + 543);
$thai_date_to = date('d/m/', strtotime($date_to)) . (date('Y', strtotime($date_to)) + 543);
$meal_display = ($meal_filter === 'all') ? 'ทุกมื้อ' : $meal_labels[$meal_filter];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สรุปรายการวัตถุดิบ - รพ.เทพา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 13px;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .print-page {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .report-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
            color: #fff;
            padding: 25px 30px;
            position: relative;
        }
        .report-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #48bb78, #38a169);
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logo-container {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .logo-container img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        .header-text h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }
        .header-text .hospital-name {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        .header-text .report-type {
            font-size: 14px;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 8px;
        }
        .info-section {
            background: #f8fafc;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .info-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
        }
        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
        }
        .table-section {
            padding: 25px 30px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #48bb78;
            padding-bottom: 8px;
        }
        .section-title i {
            color: #48bb78;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 25px;
        }
        .data-table thead th {
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            color: #fff;
            padding: 10px 8px;
            text-align: center;
            font-weight: 500;
            border: none;
        }
        .data-table thead th:first-child { border-radius: 8px 0 0 0; }
        .data-table thead th:last-child { border-radius: 0 8px 0 0; }
        .data-table tbody td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        .data-table tbody tr:hover { background: #f8fafc; }
        .data-table tbody tr:nth-child(even) { background: #f1f5f9; }
        .type-header {
            background: #e8f5e9 !important;
            font-weight: 600;
            color: #2e7d32;
        }
        .total-row {
            background: #fff3e0 !important;
            font-weight: 600;
        }
        .no-print { margin-bottom: 20px; text-align: center; }
        @media print {
            body { background: #fff; padding: 0; }
            .print-page { box-shadow: none; border-radius: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="no-print">
    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-1"></i> พิมพ์</button>
    <button onclick="window.close()" class="btn btn-secondary"><i class="fas fa-times me-1"></i> ปิด</button>
</div>

<div class="print-page">
    <div class="report-header">
        <div class="header-content">
            <div class="logo-container">
                <img src="images/logo.png" alt="Logo" onerror="this.src='https://via.placeholder.com/60'">
            </div>
            <div class="header-text">
                <p class="hospital-name">โรงพยาบาลเทพา</p>
                <h1>สรุปรายการวัตถุดิบอาหาร</h1>
                <span class="report-type"><i class="fas fa-shopping-cart me-1"></i> รายการสำหรับจัดซื้อ</span>
            </div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                <div>
                    <div class="info-label">วันที่</div>
                    <div class="info-value"><?= $thai_date_from ?><?= ($date_from !== $date_to) ? ' - ' . $thai_date_to : '' ?></div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="info-label">มื้ออาหาร</div>
                    <div class="info-value"><?= h($meal_display) ?></div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-clipboard-list"></i></div>
                <div>
                    <div class="info-label">จำนวนรายการ</div>
                    <div class="info-value"><?= count($histories) ?> มื้อ</div>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon"><i class="fas fa-print"></i></div>
                <div>
                    <div class="info-label">พิมพ์เมื่อ</div>
                    <div class="info-value"><?= date('d/m/') . (date('Y') + 543) . ' ' . date('H:i') ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Meal Details -->
    <div class="table-section">
        <div class="section-title"><i class="fas fa-list"></i> รายการมื้ออาหารที่รวม</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="15%">วันที่</th>
                    <th width="10%">มื้อ</th>
                    <th width="35%">อาหาร (ธรรมดา)</th>
                    <th width="10%">จำนวน</th>
                    <th width="15%">อาหาร (พิเศษ)</th>
                    <th width="10%">จำนวน</th>
                </tr>
            </thead>
            <tbody>
<?php
$hi = 1;
foreach ($histories as $hist) {
    $td = date('d/m/', strtotime($hist['calc_date'])) . (date('Y', strtotime($hist['calc_date'])) + 543);
    // Get menu names
    $nids = implode(',', array_map('intval', explode(',', $hist['menu_ids_normal'])));
    $n_res = mysqli_query($conn, "SELECT GROUP_CONCAT(menu_name ORDER BY menu_name SEPARATOR ', ') as names FROM menu WHERE menu_id IN ($nids)");
    $n_row = mysqli_fetch_array($n_res);
    $normal_names = $n_row['names'] ?? '-';

    $special_names = '-';
    if (!empty($hist['menu_ids_special'])) {
        $sids = implode(',', array_map('intval', explode(',', $hist['menu_ids_special'])));
        $s_res = mysqli_query($conn, "SELECT GROUP_CONCAT(menu_name ORDER BY menu_name SEPARATOR ', ') as names FROM menu WHERE menu_id IN ($sids)");
        $s_row = mysqli_fetch_array($s_res);
        $special_names = $s_row['names'] ?? '-';
    }
    echo '<tr>';
    echo '<td class="text-center">'.$hi.'</td>';
    echo '<td class="text-center">'.$td.'</td>';
    echo '<td class="text-center">'.$meal_labels[$hist['meal_type']].'</td>';
    echo '<td>'.h($normal_names).'</td>';
    echo '<td class="text-center">'.number_format($hist['amount_normal']).'</td>';
    echo '<td>'.h($special_names).'</td>';
    echo '<td class="text-center">'.($hist['amount_special'] > 0 ? number_format($hist['amount_special']) : '-').'</td>';
    echo '</tr>';
    $hi++;
}
if (empty($histories)) {
    echo '<tr><td colspan="7" class="text-center text-muted py-3">ไม่พบข้อมูล</td></tr>';
}
?>
            </tbody>
        </table>
    </div>

    <!-- Ingredients grouped by type -->
<?php if (!empty($all_ingredients) || !empty($all_garnishes)): ?>
    <div class="table-section">
        <div class="section-title"><i class="fas fa-shopping-basket"></i> สรุปวัตถุดิบที่ต้องจัดซื้อ (แยกประเภท)</div>
        
<?php foreach ($all_ingredients as $type_name => $ingredients): ?>
        <h6 class="mt-3 mb-2" style="color: #2e7d32; font-weight: 600;"><i class="fas fa-tag me-1"></i><?= h($type_name) ?></h6>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="35%">วัตถุดิบ</th>
                    <th width="15%">กรัม</th>
                    <th width="15%">กก.</th>
                    <th width="15%">ฟอง</th>
                    <th width="15%">ตัว</th>
                </tr>
            </thead>
            <tbody>
<?php
    $num = 1;
    $type_total_grams = 0;
    foreach ($ingredients as $name => $data) {
        $type_total_grams += $data['grams'];
        echo '<tr>';
        echo '<td class="text-center">'.$num.'</td>';
        echo '<td>'.h($name).'</td>';
        echo '<td class="text-end">'.number_format($data['grams'], 1).'</td>';
        echo '<td class="text-end">'.number_format($data['grams'] / 1000, 2).'</td>';
        echo '<td class="text-center">'.($data['is_egg'] ? number_format($data['egg'], 1) : '-').'</td>';
        echo '<td class="text-center">'.($data['is_fish'] ? number_format($data['fish']) : '-').'</td>';
        echo '</tr>';
        $num++;
    }
?>
                <tr class="total-row">
                    <td colspan="2" class="text-end"><strong>รวม <?= h($type_name) ?></strong></td>
                    <td class="text-end"><strong><?= number_format($type_total_grams, 1) ?></strong></td>
                    <td class="text-end"><strong><?= number_format($type_total_grams / 1000, 2) ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
<?php endforeach; ?>

<?php if (!empty($all_garnishes)): ?>
        <h6 class="mt-3 mb-2" style="color: #2e7d32; font-weight: 600;"><i class="fas fa-seedling me-1"></i>ผักโรยหน้า</h6>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="35%">วัตถุดิบ</th>
                    <th width="20%">กรัม</th>
                    <th width="20%">กก.</th>
                    <th width="20%">หมายเหตุ</th>
                </tr>
            </thead>
            <tbody>
<?php
    $gn = 1;
    $garnish_total = 0;
    foreach ($all_garnishes as $g_name => $g_value) {
        $garnish_total += $g_value;
        echo '<tr>';
        echo '<td class="text-center">'.$gn.'</td>';
        echo '<td>'.h($g_name).'</td>';
        echo '<td class="text-end">'.number_format($g_value, 1).'</td>';
        echo '<td class="text-end">'.number_format($g_value / 1000, 2).'</td>';
        echo '<td class="text-center">-</td>';
        echo '</tr>';
        $gn++;
    }
?>
                <tr class="total-row">
                    <td colspan="2" class="text-end"><strong>รวมผักโรยหน้า</strong></td>
                    <td class="text-end"><strong><?= number_format($garnish_total, 1) ?></strong></td>
                    <td class="text-end"><strong><?= number_format($garnish_total / 1000, 2) ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
<?php endif; ?>
    </div>
<?php endif; ?>

    <!-- Footer -->
    <div style="padding: 20px 30px; border-top: 2px solid #e2e8f0; display: flex; justify-content: space-between;">
        <div>
            <p style="margin: 0; font-size: 11px; color: #94a3b8;">ผู้จัดทำ: .................................................</p>
            <p style="margin: 5px 0 0; font-size: 11px; color: #94a3b8;">วันที่: .................................................</p>
        </div>
        <div>
            <p style="margin: 0; font-size: 11px; color: #94a3b8;">ผู้ตรวจสอบ: .................................................</p>
            <p style="margin: 5px 0 0; font-size: 11px; color: #94a3b8;">วันที่: .................................................</p>
        </div>
    </div>
</div>

</body>
</html>
