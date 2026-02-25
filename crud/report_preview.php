<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$meal_labels = ['breakfast' => 'เช้า', 'lunch' => 'เที่ยง', 'dinner' => 'เย็น'];

$date_from = $_GET['date_from'] ?? date('Y-m-d');
$date_to = $_GET['date_to'] ?? date('Y-m-d');
$meal_filter = $_GET['meal_type'] ?? 'all';

$params = ['date_from' => $date_from, 'date_to' => $date_to];
$where = "calc_date BETWEEN :date_from AND :date_to";
if ($meal_filter !== 'all' && in_array($meal_filter, ['breakfast', 'lunch', 'dinner'])) {
    $where .= " AND meal_type = :meal_type";
    $params['meal_type'] = $meal_filter;
}

$stmt = $pdo->prepare("SELECT * FROM calculate_history WHERE $where ORDER BY calc_date, FIELD(meal_type, 'breakfast', 'lunch', 'dinner')");
$stmt->execute($params);
$histories = $stmt->fetchAll();

if (empty($histories)) {
    echo '<div class="alert alert-warning text-center"><i class="fas fa-exclamation-triangle me-2"></i>ไม่พบข้อมูลในช่วงวันที่และมื้อที่เลือก</div>';
    exit();
}

echo '<div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>พบ <strong>' . count($histories) . '</strong> รายการ</div>';
echo '<div class="table-responsive"><table class="table table-bordered table-striped table-sm">';
echo '<thead><tr><th class="text-center">#</th><th class="text-center">วันที่</th><th class="text-center">มื้อ</th><th>อาหาร (ธรรมดา)</th><th class="text-center">จำนวน</th><th>อาหาร (พิเศษ)</th><th class="text-center">จำนวน</th></tr></thead><tbody>';

$i = 1;
foreach ($histories as $hist) {
    $td = date('d/m/', strtotime($hist['calc_date'])) . (date('Y', strtotime($hist['calc_date'])) + 543);
    
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

    $meal_label = $meal_labels[$hist['meal_type']] ?? $hist['meal_type'];
    $meal_colors = ['breakfast' => 'info', 'lunch' => 'warning', 'dinner' => 'primary'];
    $meal_color = $meal_colors[$hist['meal_type']] ?? 'secondary';

    echo '<tr>';
    echo '<td class="text-center">'.$i.'</td>';
    echo '<td class="text-center">'.$td.'</td>';
    echo '<td class="text-center"><span class="badge bg-'.$meal_color.'">'.$meal_label.'</span></td>';
    echo '<td>'.h($normal_names).'</td>';
    echo '<td class="text-center">'.number_format($hist['amount_normal']).'</td>';
    echo '<td>'.h($special_names).'</td>';
    echo '<td class="text-center">'.($hist['amount_special'] > 0 ? number_format($hist['amount_special']) : '-').'</td>';
    echo '</tr>';
    $i++;
}

echo '</tbody></table></div>';
?>
