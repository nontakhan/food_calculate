<?php
require_once 'session.php';
require_once dirname(__DIR__) . '/_db/connect.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo '<div class="alert alert-danger">ไม่พบข้อมูล</div>';
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM calculate_history WHERE history_id = :id");
$stmt->execute(['id' => $id]);
$history = $stmt->fetch();

if (!$history) {
    echo '<div class="alert alert-danger">ไม่พบข้อมูล</div>';
    exit();
}

$meal_labels = ['breakfast' => 'เช้า', 'lunch' => 'เที่ยง', 'dinner' => 'เย็น'];
$thai_date = date('d/m/', strtotime($history['calc_date'])) . (date('Y', strtotime($history['calc_date'])) + 543);

$menu_final = implode(',', array_map('intval', explode(',', $history['menu_ids_normal'])));
$menu_final2 = !empty($history['menu_ids_special']) ? implode(',', array_map('intval', explode(',', $history['menu_ids_special']))) : '';
$total_menu = $menu_final2 ? $menu_final . ',' . $menu_final2 : $menu_final;
$total = intval($history['amount_normal']);
$total2 = intval($history['amount_special']);
?>

<div class="bg-light p-3 rounded mb-3">
    <div class="row text-center">
        <div class="col-md-3"><small class="text-muted d-block">วันที่</small><strong><?= $thai_date ?></strong></div>
        <div class="col-md-3"><small class="text-muted d-block">มื้ออาหาร</small><strong><?= $meal_labels[$history['meal_type']] ?? '' ?></strong></div>
        <div class="col-md-2"><small class="text-muted d-block">ห้องธรรมดา</small><strong><?= number_format($total) ?> คน</strong></div>
        <div class="col-md-2"><small class="text-muted d-block">ห้องพิเศษ</small><strong><?= number_format($total2) ?> คน</strong></div>
        <div class="col-md-2"><small class="text-muted d-block">รวม</small><strong><?= number_format($total + $total2) ?> คน</strong></div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered table-sm mb-0">
        <thead class="table-light">
            <tr>
                <th class="text-center" width="5%">#</th>
                <th class="text-center" width="10%">ประเภท</th>
                <th width="20%">อาหาร</th>
                <th width="20%">วัตถุดิบ</th>
                <th class="text-center" width="8%">จำนวน</th>
                <th class="text-end" width="12%">กรัม</th>
                <th class="text-center" width="8%">ฟอง</th>
                <th class="text-center" width="7%">ตัว</th>
                <th class="text-end" width="10%">กก.</th>
            </tr>
        </thead>
        <tbody>
<?php
$row_num = 1;
if (!empty($menu_final2)) {
    $sql3 = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, f.factor_value FROM staple s LEFT JOIN menu m ON m.menu_id = s.menu_id LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id WHERE m.menu_id IN ($menu_final2) ORDER BY m.menu_id";
    $res3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_array($res3)) {
        $yield3 = ($row3['staple_serve'] * $row3['factor_value'] * 100) / $row3['staple_yield'];
        $egg3 = (strpos($row3['staple_name'], 'ไข่') !== false) ? number_format(($yield3 * $total2) / 31.9, 2) : '-';
        $fish3 = ($row3['is_fish'] == 1) ? $total2 : '-';
        echo '<tr class="table-primary"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-primary">พิเศษ</span></td><td>'.h($row3['menu_name']).'</td><td>'.h($row3['staple_name']).'</td><td class="text-center">'.number_format($total2).'</td><td class="text-end">'.number_format($yield3 * $total2, 1).'</td><td class="text-center">'.$egg3.'</td><td class="text-center">'.$fish3.'</td><td class="text-end">'.number_format(($yield3 * $total2) / 1000, 2).'</td></tr>';
        $row_num++;
    }
}
$sql4 = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, f.factor_value FROM staple s LEFT JOIN menu m ON m.menu_id = s.menu_id LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id WHERE m.menu_id IN ($menu_final) ORDER BY m.menu_id";
$res4 = mysqli_query($conn, $sql4);
while ($row4 = mysqli_fetch_array($res4)) {
    $yield4 = ($row4['staple_serve'] * $row4['factor_value'] * 100) / $row4['staple_yield'];
    $egg4 = (strpos($row4['staple_name'], 'ไข่') !== false) ? number_format(($yield4 * $total) / 31.9, 2) : '-';
    $fish4 = ($row4['is_fish'] == 1) ? $total : '-';
    echo '<tr class="table-warning"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-warning text-dark">ธรรมดา</span></td><td>'.h($row4['menu_name']).'</td><td>'.h($row4['staple_name']).'</td><td class="text-center">'.number_format($total).'</td><td class="text-end">'.number_format($yield4 * $total, 1).'</td><td class="text-center">'.$egg4.'</td><td class="text-center">'.$fish4.'</td><td class="text-end">'.number_format(($yield4 * $total) / 1000, 2).'</td></tr>';
    $row_num++;
}
$sql5 = "SELECT GROUP_CONCAT(menu_name) menu_name, garnish_name, garnish_value FROM (SELECT g.garnish_name, g.garnish_value, m.menu_name FROM garnish g LEFT JOIN menu m ON m.menu_id = g.menu_id WHERE m.menu_id IN ($total_menu)) a GROUP BY garnish_name ORDER BY menu_name";
$res5 = mysqli_query($conn, $sql5);
while ($row5 = mysqli_fetch_array($res5)) {
    echo '<tr class="table-success"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-success">ผักโรยหน้า</span></td><td>'.h($row5['menu_name']).'</td><td>'.h($row5['garnish_name']).'</td><td class="text-center">'.number_format($total + $total2).'</td><td class="text-end">'.number_format($row5['garnish_value'], 1).'</td><td class="text-center">-</td><td class="text-center">-</td><td class="text-end">'.number_format($row5['garnish_value'] / 1000, 2).'</td></tr>';
    $row_num++;
}
?>
        </tbody>
    </table>
</div>
