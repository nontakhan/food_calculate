<?php
include 'session.php';
include '_db/connect.php';
$menu = 'calculate';
$csrf_token = generateCsrfToken();
include 'header.php';
?>

<section class="content-header">
    <div class="container-fluid">
        <h1><i class="fas fa-calculator me-2"></i>ระบบคำนวณวัตถุดิบอาหาร</h1>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-utensils me-2"></i>เลือกรายการอาหารและจำนวนผู้ป่วย</h5>
        </div>
        <div class="card-body">
            <form action="calculate.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                <div class="row g-3 mb-3">
                    <div class="col-lg-9">
                        <label class="form-label fw-bold"><i class="fas fa-bed me-1 text-primary"></i> รายการอาหาร (ห้องธรรมดา) <span class="text-danger">*</span></label>
                        <select name="menu_id[]" multiple class="form-control select2" required>
                            <?php
                            $sql1 = 'SELECT * FROM menu ORDER BY menu_name';
                            $res1 = mysqli_query($conn, $sql1);
                            while($row1 = mysqli_fetch_array($res1)) {
                                echo '<option value="'.intval($row1['menu_id']).'">'.h($row1['menu_name']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-bold"><i class="fas fa-users me-1 text-primary"></i> จำนวนผู้ป่วย <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg text-center" required name="amount" min="1" placeholder="0">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-lg-9">
                        <label class="form-label fw-bold"><i class="fas fa-star me-1 text-warning"></i> รายการอาหาร (ห้องพิเศษ)</label>
                        <select name="menu_id2[]" multiple class="form-control select2">
                            <?php
                            $sql2 = 'SELECT * FROM menu ORDER BY menu_name';
                            $res2 = mysqli_query($conn, $sql2);
                            while($row2 = mysqli_fetch_array($res2)) {
                                echo '<option value="'.intval($row2['menu_id']).'">'.h($row2['menu_name']).'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label fw-bold"><i class="fas fa-users me-1 text-warning"></i> จำนวนผู้ป่วย</label>
                        <input type="number" class="form-control form-control-lg text-center" name="amount2" min="0" placeholder="0">
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5"><i class="fas fa-calculator me-2"></i> คำนวณวัตถุดิบ</button>
                </div>
            </form>
        </div>
    </div>

<?php
if(isset($_POST['menu_id']) && !empty($_POST['menu_id']) && isset($_POST['amount']) && $_POST['amount'] > 0) { 
    // Validate CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        echo '<div class="alert alert-danger">เกิดข้อผิดพลาดด้านความปลอดภัย กรุณาลองใหม่</div>';
        exit();
    }
    // Sanitize: ensure all menu IDs are integers to prevent SQL Injection
    $menu_ids1 = array_map('intval', $_POST['menu_id']);
    $menu_final = implode(',', $menu_ids1);
    $menu_final2 = '';
    if (isset($_POST['menu_id2']) && !empty($_POST['menu_id2'])) {
        $menu_ids2 = array_map('intval', $_POST['menu_id2']);
        $menu_final2 = implode(',', $menu_ids2);
    }
    $total_menu = $menu_final2 ? $menu_final.','.$menu_final2 : $menu_final;
    $total = intval($_POST['amount']);
    $total2 = isset($_POST['amount2']) ? intval($_POST['amount2']) : 0;
?>
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>ผลการคำนวณวัตถุดิบ</h5>
                <div class="d-flex gap-2">
                    <button class="btn btn-light btn-sm" onclick="window.open('print2.php?values1=<?= $menu_final ?>&values2=<?= $menu_final2 ?>&total_menu=<?= $total_menu ?>&amount1=<?= $total ?>&amount2=<?= $total2 ?>','_blank')"><i class="fas fa-print me-1"></i> สรุปทั้งหมด</button>
                    <button class="btn btn-info btn-sm" onclick="window.open('print3.php?values1=<?= $menu_final ?>&values2=<?= $menu_final2 ?>&total_menu=<?= $total_menu ?>&amount1=<?= $total ?>&amount2=<?= $total2 ?>','_blank')"><i class="fas fa-leaf me-1"></i> สรุปผัก</button>
                    <button class="btn btn-warning btn-sm" onclick="window.open('print4.php?values1=<?= $menu_final ?>&values2=<?= $menu_final2 ?>&total_menu=<?= $total_menu ?>&amount1=<?= $total ?>&amount2=<?= $total2 ?>','_blank')"><i class="fas fa-drumstick-bite me-1"></i> สรุปเนื้อสัตว์</button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="bg-light p-3 border-bottom">
                <div class="row text-center">
                    <div class="col-md-4"><i class="fas fa-bed fa-lg text-primary"></i><small class="text-muted d-block">ห้องธรรมดา</small><strong><?= number_format($total) ?> คน</strong></div>
                    <div class="col-md-4"><i class="fas fa-star fa-lg text-warning"></i><small class="text-muted d-block">ห้องพิเศษ</small><strong><?= number_format($total2) ?> คน</strong></div>
                    <div class="col-md-4"><i class="fas fa-users fa-lg text-success"></i><small class="text-muted d-block">รวมทั้งหมด</small><strong><?= number_format($total + $total2) ?> คน</strong></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center" width="10%">ประเภท</th>
                            <th width="18%">อาหาร</th>
                            <th width="18%">วัตถุดิบ</th>
                            <th class="text-center" width="8%">จำนวน</th>
                            <th class="text-end" width="12%">กรัม</th>
                            <th class="text-center" width="8%">ฟอง</th>
                            <th class="text-center" width="8%">ตัว</th>
                            <th class="text-end" width="13%">กก.</th>
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
        echo '<tr class="table-primary"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-primary">พิเศษ</span></td><td>'.htmlspecialchars($row3['menu_name']).'</td><td>'.htmlspecialchars($row3['staple_name']).'</td><td class="text-center">'.number_format($total2).'</td><td class="text-end">'.number_format($yield3 * $total2, 1).'</td><td class="text-center">'.$egg3.'</td><td class="text-center">'.$fish3.'</td><td class="text-end">'.number_format(($yield3 * $total2) / 1000, 2).'</td></tr>';
        $row_num++;
    }
}
$sql4 = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish, f.factor_value FROM staple s LEFT JOIN menu m ON m.menu_id = s.menu_id LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id WHERE m.menu_id IN ($menu_final) ORDER BY m.menu_id";
$res4 = mysqli_query($conn, $sql4);
while ($row4 = mysqli_fetch_array($res4)) {
    $yield4 = ($row4['staple_serve'] * $row4['factor_value'] * 100) / $row4['staple_yield'];
    $egg4 = (strpos($row4['staple_name'], 'ไข่') !== false) ? number_format(($yield4 * $total) / 31.9, 2) : '-';
    $fish4 = ($row4['is_fish'] == 1) ? $total : '-';
    echo '<tr class="table-warning"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-warning text-dark">ธรรมดา</span></td><td>'.htmlspecialchars($row4['menu_name']).'</td><td>'.htmlspecialchars($row4['staple_name']).'</td><td class="text-center">'.number_format($total).'</td><td class="text-end">'.number_format($yield4 * $total, 1).'</td><td class="text-center">'.$egg4.'</td><td class="text-center">'.$fish4.'</td><td class="text-end">'.number_format(($yield4 * $total) / 1000, 2).'</td></tr>';
    $row_num++;
}
$sql5 = "SELECT GROUP_CONCAT(menu_name) menu_name, garnish_name, garnish_value FROM (SELECT g.garnish_name, g.garnish_value, m.menu_name FROM garnish g LEFT JOIN menu m ON m.menu_id = g.menu_id WHERE m.menu_id IN ($total_menu)) a GROUP BY garnish_name ORDER BY menu_name";
$res5 = mysqli_query($conn, $sql5);
while ($row5 = mysqli_fetch_array($res5)) {
    echo '<tr class="table-success"><td class="text-center">'.$row_num.'</td><td class="text-center"><span class="badge bg-success">ผักโรยหน้า</span></td><td>'.htmlspecialchars($row5['menu_name']).'</td><td>'.htmlspecialchars($row5['garnish_name']).'</td><td class="text-center">'.number_format($total + $total2).'</td><td class="text-end">'.number_format($row5['garnish_value'], 1).'</td><td class="text-center">-</td><td class="text-center">-</td><td class="text-end">'.number_format($row5['garnish_value'] / 1000, 2).'</td></tr>';
    $row_num++;
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
</section>
<?php include 'footer.php'; ?>
</body>
</html>